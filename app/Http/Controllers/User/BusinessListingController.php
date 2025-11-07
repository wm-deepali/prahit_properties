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
        $user = auth()->user();

        // 🧩 Load user's active subscription with its package
        $activeSubscription = $user->activeSubscription()
            ->with('package')
            ->first();

        // Store current URL for redirect (in case of failure)
        $redirectUrl = urlencode(url()->current());

        // 🚫 No active subscription
        if (!$activeSubscription) {
            return redirect()->to(url("/user/pricing?type=service&redirect_url={$redirectUrl}"))
                ->with('error', 'You must have an active subscription to post your business listing.');
        }

        $package = $activeSubscription->package;

        // 🚫 Subscription exists but package missing or not Service type
        if (!$package || $package->package_type !== 'service') {
            return redirect()->to(url("/user/pricing?type=service&redirect_url={$redirectUrl}"))
                ->with('error', 'You must have an active Service package to post your business listing.');
        }

        // 🚫 Package does not allow Business Listing
        if (empty($package->business_listing) || strtolower($package->business_listing) !== 'yes') {
            return redirect()->to(url("/user/pricing?type=service&redirect_url={$redirectUrl}"))
                ->with('error', 'Your current package does not include Business Listing.');
        }

        // ✅ All checks passed — allow access
        $categories = WebDirectoryCategory::all();
        $subCategories = WebDirectorySubCategory::all();
        $property_categories = Category::latest()->get();

        // 🟩 Extract required package limits
        $total_services = $package->total_services ?? 0;
        $business_logo_banner = $package->business_logo_banner ?? 'No';

        return view('front.create_business_listing', compact(
            'categories',
            'subCategories',
            'property_categories',
            'package',
            'total_services',
            'business_logo_banner'
        ));
    }




    public function store(Request $request)
    {
        $userId = Auth::id();

        // Check if user already has a business listing
        $existingBusiness = BusinessListing::where('user_id', $userId)->first();

        if ($existingBusiness) {
            return redirect()->back()->with('error', 'You already have a business listing and cannot create another.');
        }

        $validator = Validator::make($request->all(), [
            'membership_type' => 'required|in:Free,Paid',
            'verified_status' => 'required|in:Verified,Unverified',
            'category_id' => 'required|exists:web_directory_categories,id',
            'sub_category_ids' => 'required|array',
            'sub_category_ids.*' => 'exists:web_directory_sub_categories,id',

            // property single select
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
            'registration_number' => 'nullable|string|max:255', // ✅ new
            'deals_in' => 'nullable|string|max:500',           // ✅ new
            'satisfied_clients' => 'nullable|integer|min:0',   // ✅ new

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

            // Services
            'services' => 'nullable|array',
            'services.*.name' => 'required_with:services|string|max:255',
            'services.*.description' => 'nullable|string|max:1000',
            'services.*.price' => 'nullable|numeric|min:0',
            'services.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Portfolio
            'portfolio' => 'nullable|array',
            'portfolio.*.title' => 'required_with:portfolio|string|max:255',
            'portfolio.*.link' => 'nullable|url|max:255',
            'portfolio.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Working hours
            'working_hours' => 'nullable|array',
            'working_hours.*.day' => 'required_with:working_hours|string|max:50',
            'working_hours.*.start' => 'nullable|required_without:working_hours.*.closed|date_format:H:i',
            'working_hours.*.end' => 'nullable|required_without:working_hours.*.closed|date_format:H:i',
            'working_hours.*.closed' => 'nullable|boolean',
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
                'pin_code',
                'registration_number',   // ✅ new
                'deals_in',              // ✅ new
                'satisfied_clients',     // ✅ new
            ]));

            $business->user_id = Auth::id();
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

            // Property Categories
            if ($request->property_category_id) {
                if ($request->property_category_id === 'all') {
                    $allPropertyCategories = Category::pluck('id')->toArray();
                    $business->propertyCategories()->sync($allPropertyCategories);
                } else {
                    $business->propertyCategories()->sync([$request->property_category_id]);
                }
            }

            // Property Subcategories
            if ($request->property_subcategory_id) {
                if ($request->property_subcategory_id === 'all') {
                    $allSubCategories = SubCategory::where('category_id', $request->property_category_id)->pluck('id')->toArray();
                    $business->propertySubCategories()->sync($allSubCategories);
                } else {
                    $business->propertySubCategories()->sync([$request->property_subcategory_id]);
                }
            }

            // Property Sub-SubCategories
            if ($request->sub_sub_category_ids) {
                $business->propertySubSubCategories()->sync($request->sub_sub_category_ids);
            }

            // Services
            if ($request->services) {
                foreach ($request->services as $service) {
                    $serviceModel = $business->services()->create([
                        'name' => $service['name'],
                        'description' => $service['description'] ?? null,
                        'price' => $service['price'] ?? null,
                    ]);

                    if (!empty($service['image'])) {
                        $serviceModel->image = $service['image']->store('business/services', 'public');
                        $serviceModel->save();
                    }
                }
            }

            // Portfolio
            if ($request->portfolio) {
                foreach ($request->portfolio as $portfolio) {
                    $portfolioModel = $business->portfolio()->create([
                        'title' => $portfolio['title'],
                        'link' => $portfolio['link'] ?? null,
                    ]);

                    if (!empty($portfolio['image'])) {
                        $portfolioModel->image = $portfolio['image']->store('business/portfolio', 'public');
                        $portfolioModel->save();
                    }
                }
            }

            // Working Hours
            if ($request->working_hours) {
                foreach ($request->working_hours as $wh) {
                    $business->workingHours()->create([
                        'day' => $wh['day'],
                        'start' => $wh['closed'] ?? false ? null : $wh['start'],
                        'end' => $wh['closed'] ?? false ? null : $wh['end'],
                        'closed' => !empty($wh['closed']) ? 1 : 0,
                    ]);
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
            'services',
            'portfolio',
            'workingHours'
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
        $business = BusinessListing::with(['services', 'portfolio', 'workingHours'])->findOrFail($id);

        // dd('here',$request->all());
        $validator = Validator::make($request->all(), [
            'membership_type' => 'required|in:Free,Paid',
            'verified_status' => 'required|in:Verified,Unverified',
            'category_id' => 'required|exists:web_directory_categories,id',
            'sub_category_ids' => 'required|array',
            'sub_category_ids.*' => 'exists:web_directory_sub_categories,id',

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
            'registration_number' => 'nullable|string|max:255', // ✅ new
            'deals_in' => 'nullable|string|max:500',           // ✅ new
            'satisfied_clients' => 'nullable|integer|min:0',   // ✅ new
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

            // Services
            'services' => 'nullable|array',
            'services.*.id' => 'nullable|exists:business_services,id',
            'services.*.name' => 'required_with:services|string|max:255',
            'services.*.description' => 'nullable|string|max:1000',
            'services.*.price' => 'nullable|numeric|min:0',
            'services.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Portfolio
            'portfolio' => 'nullable|array',
            'portfolio.*.id' => 'nullable|exists:business_portfolios,id',
            'portfolio.*.title' => 'required_with:portfolio|string|max:255',
            'portfolio.*.link' => 'nullable|url|max:255',
            'portfolio.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Working hours
            'working_hours' => 'nullable|array',
            'working_hours.*.id' => 'nullable|exists:business_working_hours,id',
            'working_hours.*.day' => 'required_with:working_hours|string|max:50',
            'working_hours.*.start' => 'nullable|required_without:working_hours.*.closed|date_format:H:i',
            'working_hours.*.end' => 'nullable|required_without:working_hours.*.closed|date_format:H:i',
            'working_hours.*.closed' => 'nullable|boolean',
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
                'pin_code',
                'registration_number',   // ✅ new
                'deals_in',              // ✅ new
                'satisfied_clients',     // ✅ new
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

            // Property Categories
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

            // Property SubCategories
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
            $toDelete = array_diff($existingServiceIds, $submittedServiceIds);
            if ($toDelete) {
                $business->services()->whereIn('id', $toDelete)->delete();
            }
            if ($request->services) {
                foreach ($request->services as $serviceData) {
                    if (!empty($serviceData['id'])) {
                        $service = $business->services()->find($serviceData['id']);
                        $service->name = $serviceData['name'];
                        $service->description = $serviceData['description'] ?? null;
                        $service->price = $serviceData['price'] ?? null;
                    } else {
                        $service = $business->services()->create([
                            'name' => $serviceData['name'],
                            'description' => $serviceData['description'] ?? null,
                            'price' => $serviceData['price'] ?? null,
                        ]);
                    }
                    if (isset($serviceData['image']) && $serviceData['image']) {
                        $service->image = $serviceData['image']->store('business/services', 'public');
                    }
                    $service->save();
                }
            }

            // Portfolio
            $existingPortfolioIds = $business->portfolio->pluck('id')->toArray();
            $submittedPortfolioIds = collect($request->portfolio ?? [])->pluck('id')->filter()->toArray();
            $toDeletePortfolio = array_diff($existingPortfolioIds, $submittedPortfolioIds);
            if ($toDeletePortfolio) {
                $business->portfolio()->whereIn('id', $toDeletePortfolio)->delete();
            }
            if ($request->portfolio) {
                foreach ($request->portfolio as $portfolioData) {
                    if (!empty($portfolioData['id'])) {
                        $portfolio = $business->portfolio()->find($portfolioData['id']);
                        $portfolio->title = $portfolioData['title'];
                        $portfolio->link = $portfolioData['link'] ?? null;
                    } else {
                        $portfolio = $business->portfolio()->create([
                            'title' => $portfolioData['title'],
                            'link' => $portfolioData['link'] ?? null,
                        ]);
                    }
                    if (isset($portfolioData['image']) && $portfolioData['image']) {
                        $portfolio->image = $portfolioData['image']->store('business/portfolio', 'public');
                    }
                    $portfolio->save();
                }
            }

            // Working Hours
            $existingWHIds = $business->workingHours->pluck('id')->toArray();
            $submittedWHIds = collect($request->working_hours ?? [])->pluck('id')->filter()->toArray();
            $toDeleteWH = array_diff($existingWHIds, $submittedWHIds);
            if ($toDeleteWH) {
                $business->workingHours()->whereIn('id', $toDeleteWH)->delete();
            }
            if ($request->working_hours) {
                foreach ($request->working_hours as $whData) {
                    if (!empty($whData['id'])) {
                        $wh = $business->workingHours()->find($whData['id']);
                        $wh->day = $whData['day'];
                        $wh->start = $whData['closed'] ?? false ? null : $whData['start'];
                        $wh->end = $whData['closed'] ?? false ? null : $whData['end'];
                        $wh->closed = !empty($whData['closed']) ? 1 : 0;
                    } else {
                        $business->workingHours()->create([
                            'day' => $whData['day'],
                            'start' => $whData['closed'] ?? false ? null : $whData['start'],
                            'end' => $whData['closed'] ?? false ? null : $whData['end'],
                            'closed' => !empty($whData['closed']) ? 1 : 0,
                        ]);
                    }
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
