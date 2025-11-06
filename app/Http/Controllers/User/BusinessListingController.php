<?php

namespace App\Http\Controllers\User;

use App\Category;
use App\SubCategory;
use App\BusinessListing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\WebDirectoryCategory;
use App\WebDirectorySubCategory;
use App\SubSubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessEnquiry;
use App\Models\BusinessWishlist;
use Illuminate\Support\Facades\Storage;

class BusinessListingController extends Controller
{

    /**
     * Show list of user's services.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch all business listings of this user
        $services = BusinessListing::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $published = $services->where('is_published', true);
        $unPublished = $services->where('is_published', false);
        return view('front.user.services.index', compact('published', 'unPublished'));
    }

    public function create()
    {

        $categories = WebDirectoryCategory::all();
        $subCategories = WebDirectorySubCategory::all();

        $property_categories = Category::latest()->get(); // 🆕
        return view('front.create_business_listing', compact(
            'categories',
            'subCategories',
            'property_categories',
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'membership_type' => 'required|in:Free,Paid',
            'verified_status' => 'required|in:Verified,Unverified',
            'category_id' => 'required|exists:web_directory_categories,id',
            'sub_category_ids' => 'required|array',
            'sub_category_ids.*' => 'exists:web_directory_sub_categories,id',

            // property single select
            'property_category_id' => 'nullable|string', // single id or 'all'
            'property_subcategory_id' => 'nullable|string',     // single id or 'all'
            'sub_sub_category_ids' => 'nullable|array',
            'sub_sub_category_ids.*' => 'exists:sub_sub_categories,id',

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

            // Services
            'services' => 'nullable|array',
            'services.*.name' => 'required_with:services|string|max:255',
            'services.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $business = new BusinessListing();
            $business->fill($request->only([
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

            // ✅ Add logged-in user ID
            $business->user_id = Auth::user()->id;

            // ✅ Default to unpublished
            $business->is_published = false;

            if ($request->hasFile('logo')) {
                $business->logo = $request->file('logo')->store('business/logo', 'public');
            }

            if ($request->hasFile('banner_image')) {
                $business->banner_image = $request->file('banner_image')->store('business/banner', 'public');
            }

            $business->save();

            // Sync main subcategories
            $business->subCategories()->sync($request->sub_category_ids);

            // Property Category (single select or "all")
            if ($request->property_category_id) {
                if ($request->property_category_id === 'all') {
                    $allPropertyCategories = Category::pluck('id')->toArray();
                    $business->propertyCategories()->sync($allPropertyCategories);
                } else {
                    $business->propertyCategories()->sync([$request->property_category_id]);
                }
            }

            // Property SubCategory (single select or "all")
            if ($request->property_subcategory_id) {
                if ($request->property_subcategory_id === 'all') {
                    $allSubCategories = SubCategory::where('category_id', $request->property_category_id)->pluck('id')->toArray();
                    $business->propertySubCategories()->sync($allSubCategories);
                } else {
                    $business->propertySubCategories()->sync([$request->property_subcategory_id]);
                }
            }

            // Property Sub-SubCategories (multiple)
            if ($request->sub_sub_category_ids) {
                $business->propertySubSubCategories()->sync($request->sub_sub_category_ids);
            }

            // Services
            if ($request->services) {
                foreach ($request->services as $service) {
                    $serviceModel = $business->services()->create([
                        'name' => $service['name'],
                    ]);

                    if (isset($service['image']) && $service['image']) {
                        $serviceModel->image = $service['image']->store('business/services', 'public');
                        $serviceModel->save();
                    }
                }
            }

            return redirect()->route('create_business_listing')
                ->with('success', 'Business created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $business = BusinessListing::with([
            'subCategories',
            'propertyCategories',
            'propertySubCategories',
            'propertySubSubCategories',
            'services'
        ])->findOrFail($id);

        $categories = WebDirectoryCategory::all();
        $subCategories = WebDirectorySubCategory::all();
        $property_categories = Category::latest()->get();
        $property_subcategories = SubCategory::latest()->get();
        $property_subsubcategories = SubSubCategory::latest()->get();

        return view('front.user.services.edit', compact(
            'business',
            'categories',
            'subCategories',
            'property_categories',
            'property_subcategories',
            'property_subsubcategories'
        ));
    }

    public function update(Request $request, $id)
    {
        $business = BusinessListing::with('services')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'membership_type' => 'required|in:Free,Paid',
            'verified_status' => 'required|in:Verified,Unverified',
            'category_id' => 'required|exists:web_directory_categories,id',
            'sub_category_ids' => 'required|array',
            'sub_category_ids.*' => 'exists:web_directory_sub_categories,id',

            // property single select or "all"
            'property_category_id' => 'nullable|string', // single id or 'all'
            'property_subcategory_id' => 'nullable|string', // single id or 'all'
            'sub_sub_category_ids' => 'nullable|array',
            'sub_sub_category_ids.*' => 'exists:sub_sub_categories,id',

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

            // Services
            'services' => 'nullable|array',
            'services.*.id' => 'nullable|exists:business_services,id',
            'services.*.name' => 'required_with:services|string|max:255',
            'services.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $business->fill($request->only([
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

            // Sync main subcategories
            $business->subCategories()->sync($request->sub_category_ids);

            // Property Category (single select or all)
            if ($request->property_category_id) {
                if ($request->property_category_id === 'all') {
                    $allPropertyCategories = Category::pluck('id')->toArray();
                    $business->propertyCategories()->sync($allPropertyCategories);
                } else {
                    $business->propertyCategories()->sync([$request->property_category_id]);
                }
            } else {
                $business->propertyCategories()->detach();
            }

            // Property SubCategory (single select or all)
            if ($request->property_subcategory_id) {
                if ($request->property_subcategory_id === 'all') {
                    $allSubCategories = SubCategory::where('category_id', $request->property_category_id)->pluck('id')->toArray();
                    $business->propertySubCategories()->sync($allSubCategories);
                } else {
                    $business->propertySubCategories()->sync([$request->property_subcategory_id]);
                }
            } else {
                $business->propertySubCategories()->detach();
            }

            // Property Sub-SubCategories
            $business->propertySubSubCategories()->sync($request->sub_sub_category_ids ?? []);

            // Services
            $existingServiceIds = $business->services->pluck('id')->toArray();
            $submittedServiceIds = collect($request->services ?? [])->pluck('id')->filter()->toArray();

            // Remove deleted services
            $toDelete = array_diff($existingServiceIds, $submittedServiceIds);
            if ($toDelete) {
                $business->services()->whereIn('id', $toDelete)->delete();
            }

            if ($request->services) {
                foreach ($request->services as $serviceData) {
                    if (!empty($serviceData['id'])) {
                        // Update existing
                        $service = $business->services()->find($serviceData['id']);
                        $service->name = $serviceData['name'];
                    } else {
                        // New service
                        $service = $business->services()->create([
                            'name' => $serviceData['name'],
                        ]);
                    }

                    if (isset($serviceData['image']) && $serviceData['image']) {
                        $service->image = $serviceData['image']->store('business/services', 'public');
                    }

                    $service->save();
                }
            }

            return redirect()->route('user.services.index')
                ->with('success', 'Business updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $service = BusinessListing::where('user_id', $user->id)->findOrFail($id);
        $service->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Business listing deleted successfully'
        ]);
    }

    /**
     * Show received service inquiries.
     */
    public function receivedInquiries()
    {
        $user = Auth::user();

        $inquiries = BusinessEnquiry::with('business')
            ->whereHas('business', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        // Count stats
        $currentMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        $lastMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $totalCount = $inquiries->count();


        return view('front.user.services.received-inquiries', compact('inquiries', 'currentMonthCount', 'lastMonthCount', 'totalCount'));
    }

    /**
     * Show inquiries sent by the user.
     */
    public function sentInquiries()
    {
        $user = Auth::user();

        $inquiries = BusinessEnquiry::with('business')
            ->where(function ($query) use ($user) {
                $query->where('email', $user->email)
                    ->orWhere('mobile', $user->mobile_number);
            })
            ->latest()
            ->get();

        // Count stats
        $currentMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        $lastMonthCount = $inquiries->whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfMonth(),
            Carbon::now()->subMonth()->endOfMonth()
        ])->count();

        $totalCount = $inquiries->count();

        return view('front.user.services.sent-inquiries', compact('inquiries', 'currentMonthCount', 'lastMonthCount', 'totalCount'));
    }

    /**
     * Show user's service wishlist.
     */
    public function wishlist()
    {
        $user = Auth::user();

        // You may need to adjust based on wishlist table structure
        $wishlist = BusinessWishlist::where('user_id', $user->id)
            ->with('business')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.user.services.wishlist', compact('wishlist'));
    }

}
