<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BusinessListing;
use App\WebDirectoryCategory;
use App\WebDirectorySubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BusinessListingController extends Controller
{
    /**
     * Display list of businesses
     */
    public function index()
    {
        $businesses = BusinessListing::with(['category', 'subCategories'])
            ->latest()->get();

        return view('admin.business-listing.index', compact('businesses'));
    }

    /**
     * Show form to create new business
     */
    public function create()
    {
        $categories = WebDirectoryCategory::all();
        $subCategories = WebDirectorySubCategory::all();

        return view('admin.business-listing.create', compact('categories', 'subCategories'));
    }

    /**
     * Store new business
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'membership_type' => 'required|in:Free,Paid',
            'verified_status' => 'required|in:Verified,Unverified',
            'category_id' => 'required|exists:web_directory_categories,id',
            'sub_category_ids' => 'required|array',
            'sub_category_ids.*' => 'exists:web_directory_sub_categories,id',
            'business_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile_number' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'established_year' => 'nullable|digits:4',
            'introduction' => 'nullable|string',
            'detail' => 'nullable|string',
            'full_address' => 'nullable|string',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'pin_code' => 'nullable|string|max:10',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'services' => 'nullable|array',
            'services.*.name' => 'required_with:services|string|max:255',
            'services.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $business = new BusinessListing();
            $business->membership_type = $request->membership_type;
            $business->verified_status = $request->verified_status;
            $business->category_id = $request->category_id;
            $business->business_name = $request->business_name;
            $business->email = $request->email;
            $business->mobile_number = $request->mobile_number;
            $business->whatsapp_number = $request->whatsapp_number;
            $business->website = $request->website;
            $business->established_year = $request->established_year;
            $business->introduction = $request->introduction;
            $business->detail = $request->detail;
            $business->full_address = $request->full_address;
            $business->state = $request->state;
            $business->city = $request->city;
            $business->pin_code = $request->pin_code;

            // Upload logo
            if ($request->hasFile('logo')) {
                $business->logo = $request->file('logo')->store('business/logo', 'public');
            }

            // Upload banner image
            if ($request->hasFile('banner_image')) {
                $business->banner_image = $request->file('banner_image')->store('business/banner', 'public');
            }

            $business->save();

            // Attach subcategories (many-to-many)
            $business->subCategories()->sync($request->sub_category_ids);

            // Save services
            if ($request->has('services')) {
                foreach ($request->services as $service) {
                    $imagePath = null;
                    if (isset($service['image'])) {
                        $imagePath = $service['image']->store('business/services', 'public');
                    }
                    $business->services()->create([
                        'name' => $service['name'],
                        'image' => $imagePath,
                    ]);
                }
            }

            return redirect()->route('admin.business-listing.index')
                ->with('success', 'Business created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $business = BusinessListing::with(['subCategories', 'services'])->findOrFail($id);
        $categories = WebDirectoryCategory::all();
        $subCategories = WebDirectorySubCategory::all();

        return view('admin.business-listing.edit', compact('business', 'categories', 'subCategories'));
    }

    /**
     * Update business
     */
    public function update(Request $request, $id)
    {
        $business = BusinessListing::with('services')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'membership_type' => 'required|in:Free,Paid',
            'verified_status' => 'required|in:Verified,Unverified',
            'category_id' => 'required|exists:web_directory_categories,id',
            'sub_category_ids' => 'required|array',
            'sub_category_ids.*' => 'exists:web_directory_sub_categories,id',
            'business_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile_number' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'established_year' => 'nullable|digits:4',
            'introduction' => 'nullable|string',
            'detail' => 'nullable|string',
            'full_address' => 'nullable|string',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'pin_code' => 'nullable|string|max:10',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'services' => 'nullable|array',
            'services.*.id' => 'nullable|exists:business_services,id',
            'services.*.name' => 'required_with:services|string|max:255',
            'services.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Update main fields
            $business->update($request->only([
                'membership_type',
                'verified_status',
                'category_id',
                'business_name',
                'email',
                'mobile_number',
                'whatsapp_number',
                'website',
                'established_year',
                'introduction',
                'detail',
                'full_address',
                'state',
                'city',
                'pin_code'
            ]));

            // Update logo/banner
            if ($request->hasFile('logo')) {
                if ($business->logo)
                    Storage::disk('public')->delete($business->logo);
                $business->logo = $request->file('logo')->store('business/logo', 'public');
            }

            if ($request->hasFile('banner_image')) {
                if ($business->banner_image)
                    Storage::disk('public')->delete($business->banner_image);
                $business->banner_image = $request->file('banner_image')->store('business/banner', 'public');
            }

            $business->save();

            // Sync subcategories
            $business->subCategories()->sync($request->sub_category_ids);

            // Handle services
            $existingServiceIds = $business->services->pluck('id')->toArray();
            $submittedServiceIds = collect($request->services ?? [])->pluck('id')->filter()->toArray();

            // Delete removed services
            $servicesToDelete = array_diff($existingServiceIds, $submittedServiceIds);
            foreach ($servicesToDelete as $serviceId) {
                $service = $business->services->find($serviceId);
                if ($service) {
                    if ($service->image)
                        Storage::disk('public')->delete($service->image);
                    $service->delete();
                }
            }

            // Update existing & add new services
            if ($request->has('services')) {
                foreach ($request->services as $serviceData) {
                    if (isset($serviceData['id']) && $serviceData['id']) {
                        // Update existing
                        $service = $business->services->find($serviceData['id']);
                        if ($service) {
                            $service->name = $serviceData['name'];
                            if (isset($serviceData['image'])) {
                                if ($service->image)
                                    Storage::disk('public')->delete($service->image);
                                $service->image = $serviceData['image']->store('business/services', 'public');
                            }
                            $service->save();
                        }
                    } else {
                        // New service
                        $imagePath = isset($serviceData['image']) ? $serviceData['image']->store('business/services', 'public') : null;
                        $business->services()->create([
                            'name' => $serviceData['name'],
                            'image' => $imagePath,
                        ]);
                    }
                }
            }

            return redirect()->route('admin.business-listing.index')
                ->with('success', 'Business updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    /**
     * Delete business
     */
    public function destroy($id)
    {
        $business = BusinessListing::findOrFail($id);

        try {
            // Delete files
            if ($business->logo)
                Storage::disk('public')->delete($business->logo);
            if ($business->banner_image)
                Storage::disk('public')->delete($business->banner_image);

            // Delete services images
            foreach ($business->services as $service) {
                if ($service->image)
                    Storage::disk('public')->delete($service->image);
            }

            $business->delete();

            return redirect()->route('admin.business-listing.index')
                ->with('success', 'Business deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
