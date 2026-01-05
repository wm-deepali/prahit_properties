<?php

namespace App\Http\Controllers;

use App\Otp;
use App\City;
use App\SubCategory;
use App\SubSubCategory;
use App\Category;
use App\Locations;
use App\Properties;
use App\SubLocations;
use App\PropertyGallery;
use App\State;
use App\Amenity;
use App\FormTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class PropertyController extends Controller
{

    public function create_property()
    {
        $user = auth()->user();

        // 🧩 Load user's active subscription with its package
        $activePropertySubscription = $user->activePropertySubscription()
            ->with('package')
            ->first();

        // Store current URL for redirect (in case of failure)
        $redirectUrl = urlencode(url()->current());
        // 🚫 No active subscription
        if (!$activePropertySubscription) {
            return redirect()->to(url("/user/pricing?type=property&redirect_url={$redirectUrl}"))
                ->with('error', 'You must have an active subscription to post your property listing.');
        }

        $package = $activePropertySubscription->package;

        // 🚫 Subscription exists but package missing or not for Property
        if (!$package || $package->package_type !== 'property') {
            return redirect()->to(url("/user/pricing?type=property&redirect_url={$redirectUrl}"))
                ->with('error', 'You must have an active Property package to post your property listing.');
        }

        // ✅ Check allowed number of listings
        $allowedListings = (int) $package->number_of_listing;

        // Count properties created after the active subscription started
        $userListingCount = $user->getProperties()
            ->where('created_at', '>=', $activePropertySubscription->start_date)
            ->count();

        if ($allowedListings > 0 && $userListingCount >= $allowedListings) {
            return redirect()->to(url("/user/pricing?type=property&redirect_url={$redirectUrl}"))
                ->with('error', 'You have reached the maximum number of property listings allowed in your current subscription.');
        }

        // ✅ Additional package limits
        $photos_per_listing = (int) ($package->photos_per_listing ?? 0);
        $video_upload = $package->video_upload;

        // ✅ Load supporting data
        $category = Category::all();
        $locations = Locations::all();
        $form_type = FormTypes::with('FormTypesFields', 'FormTypesFields.SubFeatures')->where('id', 1)->get();
        $states = State::where('country_id', 101)->get();
        $amenities = Amenity::where('status', 'Yes')->get();

        // Get all active Price Labels and Statuses
        // $price_labels = PriceLabel::where('status', 'active')->get();
        // $property_statuses = PropertyStatus::where('status', 'active')->get();
        // $registration_statuses = RegistrationStatus::where('status', 'active')->get();
        // $furnishing_statuses = FurnishingStatus::where('status', 'active')->get();

        return view('front.create_property', compact(
            'category',
            'locations',
            'form_type',
            'states',
            'amenities',
            // 'price_labels',
            // 'property_statuses',
            // 'registration_statuses',
            // 'furnishing_statuses',
            'photos_per_listing',
            'video_upload'
        ));
    }

    public function createProperty(Request $request)
    {
        // ---------------------------------------------------
        // 1️⃣ VALIDATION (MATCH FRONTEND)
        // ---------------------------------------------------
        try {
            $request->validate([
                'title' => 'required|string|max:200',
                'category_id' => 'required|integer',
                'sub_category_id' => 'nullable|integer',
                'sub_sub_category_id' => 'nullable|integer',

                'description' => 'required|string',
                'address' => 'required|string',

                'state' => 'required|integer',
                'city' => 'required|integer',
                'location_id' => 'required',

                'custom_location_input' => 'nullable|string|max:255',

                'sub_location_id' => 'nullable|array',
                'sub_location_id.*' => 'nullable|string',

                'landmark' => 'nullable|string|max:255',
                'pincode' => 'nullable|digits:6',

                'firstname' => 'required|string|max:100',
                'lastname' => 'required|string|max:100',
                'email' => 'required|email',
                'mobile_number' => 'required|digits:10',
                'otp' => 'nullable|string',

                'gallery_images_file' => 'nullable|array',
                'gallery_images_file.*' => 'image|mimes:jpg,jpeg,png|max:5120',

                'default_image_index' => 'nullable|integer',

                'property_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error occurred.',
                'errors' => $e->errors(),
            ], 422);
        }

        // ---------------------------------------------------
        // 2️⃣ OTP CHECK
        // ---------------------------------------------------
        $loggedUser = auth()->user();
        $isVerified = $loggedUser?->is_verified ?? false;
        $mobileChanged = $loggedUser && $request->mobile_number != $loggedUser->mobile_number;

        if (!$isVerified || $mobileChanged) {
            if (!$request->otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP is required.',
                ], 422);
            }

            $otp = Otp::where('otp', $request->otp)->first();
            if (!$otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP.',
                ], 400);
            }

            if (!$isVerified && !$mobileChanged && $loggedUser) {
                $loggedUser->update(['is_verified' => 1]);
            }

            $otp->delete();
        }

        // ---------------------------------------------------
        // 3️⃣ LOCATION HANDLING
        // ---------------------------------------------------
        $locationId = $request->location_id;

        if ($locationId === 'other') {
            if (!$request->custom_location_input) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter the custom location name.',
                ], 422);
            }

            $location = Locations::create([
                'state_id' => $request->state,
                'city_id' => $request->city,
                'location' => ucwords(strtolower($request->custom_location_input)),
                'status' => 1,
            ]);

            $locationId = $location->id;
        }

        // ---------------------------------------------------
        // 4️⃣ SUB LOCATIONS
        // ---------------------------------------------------
        $resolvedSubLocationIds = [];

        foreach ($request->sub_location_id ?? [] as $value) {
            $value = trim($value);
            if ($value === '')
                continue;

            if (ctype_digit($value)) {
                if ($sub = SubLocations::find($value)) {
                    $resolvedSubLocationIds[] = $sub->id;
                }
            } else {
                $sub = SubLocations::firstOrCreate([
                    'location_id' => $locationId,
                    'sub_location_name' => ucwords(strtolower($value)),
                ]);
                $resolvedSubLocationIds[] = $sub->id;
            }
        }


        /* ================= EXTRACT PRICE FROM ADDITIONAL INFO ================= */

        $price = null;
        $price =
            // Sale price
            $this->getValueFromAdditionalInfo($request->additional_info, [
                'Expected Price',
                'Exclusive Price',
                'Offer Price',
                'Starting Price',
            ])

            // Rent (flat / office / shop)
            ?? $this->getValueFromAdditionalInfo($request->additional_info, [
                'Monthly Rent',
            ])

            // PG / Hostel
            ?? $this->getValueFromAdditionalInfo($request->additional_info, [
                'Rent Per Bed',
                'Rent Per Person',
                'PG Rent',
            ]);


        // ---------------------------------------------------
        // 5️⃣ CREATE PROPERTY
        // ---------------------------------------------------
        $property = Properties::create([
            'user_id' => $loggedUser?->id,
            'listing_id' => 'PP-' . strtoupper(Str::random(8)),
            'slug' => Str::slug($request->title),

            'title' => $request->title,
            'description' => $request->description,

            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,

            'state_id' => $request->state,
            'city_id' => $request->city,
            'location_id' => $locationId,
            'sub_location_id' => implode(',', $resolvedSubLocationIds),

            'address' => $request->address,
            'landmark' => $request->landmark,
            'pincode' => $request->pincode,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            'additional_info' => $request->form_json,

            'owner_firstname' => $request->firstname,
            'owner_lastname' => $request->lastname,
            'owner_email' => $request->email,
            'owner_mobile' => $request->mobile_number,
            'price' => $price,
        ]);

        // ---------------------------------------------------
        // 6️⃣ GALLERY UPLOAD (PropertyGallery + Default Image)
        // ---------------------------------------------------
        if ($request->has('gallery_images_file')) {

            $galleryImages = $this->multipleFileUpload($request, [
                'uploads/properties/gallery_images/' => 'gallery_images_file'
            ]);

            $defaultIndex = (int) ($request->default_image_index ?? 0);

            foreach ($galleryImages as $index => $img) {
                PropertyGallery::create([
                    'property_id' => $property->id,
                    'image_path' => $img,
                    'is_default' => ($index === $defaultIndex),
                ]);
            }
        }

        // ---------------------------------------------------
        // 7️⃣ VIDEO UPLOAD
        // ---------------------------------------------------
        if ($request->hasFile('property_video')) {
            $path = $request->file('property_video')
                ->store('uploads/properties/videos', 'public');

            $property->update([
                'property_video' => 'storage/' . $path
            ]);
        }

        // ---------------------------------------------------
        // 8️⃣ SUBSCRIPTION COUNT
        // ---------------------------------------------------
        if ($property->getUser?->activePropertySubscription) {
            $property->getUser->activePropertySubscription->increment('used_listings');
        }

        // ---------------------------------------------------
        // 9️⃣ RESPONSE
        // ---------------------------------------------------
        return response()->json([
            'success' => true,
            'message' => 'Property Posted Successfully.',
            'redirect_url' => url('user/property/preview/' . $property->id),
        ]);
    }

    public function multipleFileUpload($request, $files)
    {
        $filesList = [];
        foreach ($files as $path => $value) {
            if ($request->hasfile($value)) {
                foreach ($request->file($value) as $file) {
                    $fileName = $path . rand(10000, 99999) . '_' . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/properties/gallery_images/', $fileName);
                    // $data[] = $name;  
                    // echo " $path $file $fileName <br/>";
                    array_push($filesList, $fileName);
                }
            }
        }
        return $filesList;
    }


    public function userPreviewPropertyView($id)
    {
        // 🔹 Load only required columns for property
        $property = Properties::with('SubSubCategory')->findOrFail($id);

        // 🔹 Logged-in user
        $user = auth()->user();

        // 🔹 Active subscription with package (limited columns)
        $activePropertySubscription = $user->activePropertySubscription()
            ->with(['package:id,photos_per_listing,video_upload'])
            ->first();

        // 🔹 Default limits
        $photos_per_listing = 0;
        $video_upload = 'no';

        if ($activePropertySubscription && $activePropertySubscription->package) {
            $photos_per_listing = (int) ($activePropertySubscription->package->photos_per_listing ?? 0);
            $video_upload = $activePropertySubscription->package->video_upload ?? 'no';
        }

        // 🔹 Masters that rarely change → cache them
        $category = Cache::remember('categories_all', 3600, function () {
            return Category::select('id', 'category_name')->get();
        });

        $states = Cache::remember('states_country_101', 3600, function () {
            return State::where('country_id', 101)
                ->select('id', 'name')
                ->get();
        });

        $amenities = Cache::remember('amenities_active', 3600, function () {
            return Amenity::where('status', 'Yes')
                ->select('id', 'name', 'icon')
                ->get();
        });

        // 🔹 Dependent lists (per-property)
        $cities = City::where('state_id', $property->state_id)
            ->select('id', 'name')
            ->get();

        $locations = Locations::where('city_id', $property->city_id)
            ->select('id', 'location')
            ->get();

        // If location_id is CSV in DB, keep your explode; if single id, remove explode/whereIn.
        $locationIds = is_string($property->location_id)
            ? explode(',', $property->location_id)
            : (array) $property->location_id;

        $sub_locations = SubLocations::whereIn('location_id', $locationIds)
            ->select('id', 'sub_location_name', 'location_id')
            ->get();


        $sub_categories = SubCategory::where('category_id', $property->category_id)
            ->select('id', 'sub_category_name')
            ->get();

        $sub_sub_categories = SubSubCategory::where('sub_category_id', $property->sub_category_id)
            ->select('id', 'sub_sub_category_name', )
            ->get();


        // 🔹 Property gallery
        $property_images = $property->PropertyGallery()->get();
        $defaultImageId = $property->PropertyGallery()->where('is_default', 1)->value('id');


        // ✅ Return view
        return view('front.preview_property', compact(
            'category',
            'sub_categories',
            'sub_sub_categories',
            'states',
            'cities',
            'locations',
            'sub_locations',
            'property',
            'property_images',
            'defaultImageId',
            'amenities',
            'id',
            'photos_per_listing',
            'video_upload'
        ));
    }


    public function editPropertyView($id)
    {
        // 🔹 Load only required columns for property
        $property = Properties::with('SubSubCategory')->findOrFail($id);

        // 🔹 Logged-in user
        $user = auth()->user();

        // 🔹 Active subscription with package (limited columns)
        $activePropertySubscription = $user->activePropertySubscription()
            ->with(['package:id,photos_per_listing,video_upload'])
            ->first();

        // 🔹 Default limits
        $photos_per_listing = 0;
        $video_upload = 'no';

        if ($activePropertySubscription && $activePropertySubscription->package) {
            $photos_per_listing = (int) ($activePropertySubscription->package->photos_per_listing ?? 0);
            $video_upload = $activePropertySubscription->package->video_upload ?? 'no';
        }

        // 🔹 Masters that rarely change → cache them
        $category = Cache::remember('categories_all', 3600, function () {
            return Category::select('id', 'category_name')->get();
        });

        $states = Cache::remember('states_country_101', 3600, function () {
            return State::where('country_id', 101)
                ->select('id', 'name')
                ->get();
        });

        $amenities = Cache::remember('amenities_active', 3600, function () {
            return Amenity::where('status', 'Yes')
                ->select('id', 'name', 'icon')
                ->get();
        });

        // 🔹 Dependent lists (per-property)
        $cities = City::where('state_id', $property->state_id)
            ->select('id', 'name')
            ->get();

        $locations = Locations::where('city_id', $property->city_id)
            ->select('id', 'location')
            ->get();

        // If location_id is CSV in DB, keep your explode; if single id, remove explode/whereIn.
        $locationIds = is_string($property->location_id)
            ? explode(',', $property->location_id)
            : (array) $property->location_id;

        $sub_locations = SubLocations::whereIn('location_id', $locationIds)
            ->select('id', 'sub_location_name', 'location_id')
            ->get();

        // 🔹 Property gallery (only required columns)
        $property_images = PropertyGallery::where('property_id', $id)
            ->select('id', 'image_path', 'is_default')
            ->get();

        $sub_categories = SubCategory::where('category_id', $property->category_id)
            ->select('id', 'sub_category_name')
            ->get();

        $sub_sub_categories = SubSubCategory::where('sub_category_id', $property->sub_category_id)
            ->select('id', 'sub_sub_category_name', )
            ->get();

        // ✅ Return view
        return view('front.edit_property', compact(
            'category',
            'sub_categories',
            'sub_sub_categories',
            'states',
            'cities',
            'locations',
            'sub_locations',
            'property',
            'property_images',
            'amenities',
            'photos_per_listing',
            'video_upload'
        ));
    }

    public function updateProperty(Request $request)
    {
        try {
            // ------------------------------
            // VALIDATION
            // ------------------------------
            $request->validate([
                'title' => 'required|max:200',
                'category_id' => 'required',
                'description' => 'required',
                'address' => 'required',
                'location_id' => 'required',

                'sub_location_id' => 'nullable|array',

                'gallery_images_file.*' => 'nullable|mimes:jpg,png,jpeg|max:2048',
                'property_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:100000',
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error occurred.',
                'errors' => $e->errors(),
            ], 422);
        }

        $picked = Properties::findOrFail($request->id);

        // ----------------------------------------------------------
        // OTP VALIDATION (ONLY IF MOBILE CHANGED)
        // ----------------------------------------------------------
        $originalMobile = $picked->owner_mobile ?? auth()->user()->mobile_number;
        $newMobile = $request->mobile_number;

        if ($newMobile != $originalMobile) {

            if (!$request->otp_code || strlen($request->otp_code) < 4) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP is required to update mobile number.'
                ], 422);
            }

            if (session('property_otp') != $request->otp_code) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP.'
                ], 422);
            }
        }

        // ----------------------------------------------------------
        // CUSTOM LOCATION
        // ----------------------------------------------------------
        $locationId = $request->location_id;

        if ($locationId === 'other') {
            $name = trim($request->custom_location_input);
            if (!$name) {
                return response()->json(['success' => false, 'message' => 'Enter custom location name.'], 422);
            }

            $location = Locations::create([
                'state_id' => $request->state,
                'city_id' => $request->city,
                'location' => ucwords(strtolower($name)),
                'status' => 1,
            ]);

            $locationId = $location->id;
        }

        // ----------------------------------------------------------
        // SUB LOCATIONS (WITH TAGGING)
        // ----------------------------------------------------------
        $subIds = [];

        foreach ($request->sub_location_id ?? [] as $value) {

            if (ctype_digit($value)) {
                $subIds[] = (int) $value;
            } else {
                $name = ucwords(strtolower(trim($value)));
                $sub = SubLocations::firstOrCreate(
                    ['location_id' => $locationId, 'sub_location_name' => $name]
                );
                $subIds[] = $sub->id;
            }
        }


        /* ================= EXTRACT PRICE FROM ADDITIONAL INFO ================= */

        $price = null;
        $price =
            // Sale price
            $this->getValueFromAdditionalInfo($request->additional_info, [
                'Expected Price',
                'Exclusive Price',
                'Offer Price',
                'Starting Price',
            ])

            // Rent (flat / office / shop)
            ?? $this->getValueFromAdditionalInfo($request->additional_info, [
                'Monthly Rent',
            ])

            // PG / Hostel
            ?? $this->getValueFromAdditionalInfo($request->additional_info, [
                'Rent Per Bed',
                'Rent Per Person',
                'PG Rent',
            ]);


        // ----------------------------------------------------------
        // UPDATE PROPERTY
        // ----------------------------------------------------------
        $picked->update([
            'title' => $request->title,
            'description' => $request->description,

            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,

            'state_id' => $request->state,
            'city_id' => $request->city,
            'location_id' => $locationId,
            'sub_location_id' => implode(',', $subIds),

            'address' => $request->address,
            'landmark' => $request->landmark,
            'pincode' => $request->pincode,

            'amenities' => $request->has('amenity')
                ? implode(',', $request->amenity)
                : null,

            'additional_info' => $request->form_json,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            // Owner
            'owner_firstname' => $request->firstname,
            'owner_lastname' => $request->lastname,
            'owner_email' => $request->email,
            'owner_mobile' => $request->mobile_number,
            'price' => $price,
        ]);

        // ----------------------------------------------------------
        // PROPERTY VIDEO
        // ----------------------------------------------------------
        if ($request->hasFile('property_video')) {

            if ($picked->property_video && file_exists(public_path($picked->property_video))) {
                @unlink(public_path($picked->property_video));
            }

            $video = $request->file('property_video');
            $name = time() . '_' . preg_replace('/\s+/', '_', $video->getClientOriginalName());
            $path = 'uploads/properties/videos/';
            $video->move(public_path($path), $name);

            $picked->update(['property_video' => $path . $name]);
        }

        // ----------------------------------------------------------
        // GALLERY IMAGES + DEFAULT HANDLING
        // ----------------------------------------------------------
        if ($request->hasFile('gallery_images_file')) {

            // Reset existing defaults ONLY if new default is chosen
            if ($request->filled('default_image_index')) {
                PropertyGallery::where('property_id', $picked->id)
                    ->update(['is_default' => 0]);
            }

            foreach ($request->file('gallery_images_file') as $i => $file) {

                $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/properties/gallery_images/';
                $file->move(public_path($path), $name);

                PropertyGallery::create([
                    'property_id' => $picked->id,
                    'image_path' => $path . $name,
                    'is_default' => ($request->default_image_index !== null
                        && (int) $request->default_image_index === $i),
                ]);
            }
        }

        // ----------------------------------------------------------
        // EXISTING IMAGE DEFAULT
        // ----------------------------------------------------------
        if ($request->filled('default_image_id')) {

            PropertyGallery::where('property_id', $picked->id)
                ->update(['is_default' => 0]);

            PropertyGallery::where('id', $request->default_image_id)
                ->update(['is_default' => 1]);
        }

        // ----------------------------------------------------------
        // RESPONSE
        // ----------------------------------------------------------
        return response()->json([
            'success' => true,
            'message' => 'Property updated successfully.',
            'redirect_url' => $request->from
                ? url('user/property/preview/' . $picked->id)
                : url('user/properties'),
        ]);
    }

    private function getValueFromAdditionalInfo($additionalInfoJson, array $labels)
    {
        if (!$additionalInfoJson) {
            return null;
        }

        $fields = json_decode($additionalInfoJson, true);

        if (!is_array($fields)) {
            return null;
        }

        foreach ($fields as $field) {

            if (!isset($field['label'], $field['userData'][0])) {
                continue;
            }

            $label = trim(strip_tags($field['label']));

            if (in_array($label, $labels, true)) {
                return (float) str_replace(',', '', $field['userData'][0]);
            }
        }

        return null;
    }

    public function deleteGalleryImages(Request $request)
    {
        $picked = PropertyGallery::find($request->id);
        $this->imageDeleteFromFolder('uploads/properties/gallery_images/', $picked->image_path);
        $picked->delete();
        return 'Image Deleted Successfully.';
    }

    protected function imageDeleteFromFolder($folder_path, $image)
    {
        $file = basename($image);
        if (file_exists(public_path($folder_path) . $file)) {
            unlink(public_path($folder_path) . $file);
        } else {
            return true;
        }
    }


    public function deleteProperty(Request $request)
    {
        $picked = Properties::find($request->id);
        $images = PropertyGallery::where('property_id', $picked->id)->get();
        if (count($images) > 0) {
            foreach ($images as $key => $value) {
                $this->imageDeleteFromFolder('uploads/properties/gallery_images/', $value->image_path);
                PropertyGallery::find($value->id)->delete();
            }
        }
        $picked->delete();
        return 'Package Deleted Successfully.';
    }

}
