<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Models\BusinessEnquiry;
use App\SubCategory;
use App\SubSubCategory;
use App\Http\Controllers\Controller;
use App\BusinessListing;
use App\WebDirectoryCategory;
use App\WebDirectorySubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Str;


class BusinessListingController extends Controller
{
    public function index()
    {
        // Load published and unpublished separately
        $publishedBusinesses = BusinessListing::with(['category', 'subCategories', 'propertyCategories', 'user'])
            ->where('is_published', true)
            ->latest()
            ->get();

        $unpublishedBusinesses = BusinessListing::with(['category', 'subCategories', 'propertyCategories', 'user'])
            ->where('is_published', false)
            ->latest()
            ->get();

        return view('admin.business-listing.index', compact('publishedBusinesses', 'unpublishedBusinesses'));
    }

    public function listByUser($user_id)
    {
        $user = User::with('businessListing.category')->findOrFail($user_id);

        $businessListings = $user->businessListing()
            ->with(['category', 'subCategories', 'propertyCategories', 'user'])
            ->get();

        return view('admin.business-listing.list_by_user', compact('user', 'businessListings'));
    }

    public function create()
    {
        $categories = WebDirectoryCategory::all();
        $subCategories = WebDirectorySubCategory::all();

        $property_categories = Category::latest()->get(); // 🆕

        return view('admin.business-listing.create', compact(
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

            $business->slug = Str::slug($request->business_name);

            // ✅ Add logged-in user ID
            $business->user_id = Auth::user()->id;
            $business->is_published = true;

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

            return redirect()->route('admin.business-listing.index')
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

        return view('admin.business-listing.edit', compact(
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
            $business->slug = Str::slug($request->business_name);
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

            return redirect()->route('admin.business-listing.index')
                ->with('success', 'Business updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function sendEnquiryOtp(Request $request)
    {
        $otp = rand(1000, 9999);

        // Store OTP temporarily (session or cache)
        session(['otp' => $otp, 'otp_mobile' => $request->mobile]);

        // Simulate sending SMS (replace with actual SMS API)
        $message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
        $response = $this->sendOtp($request->mobile, $message);
        if (!$response) {
            return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
        }

        return response()->json(['success' => true, 'message' => 'OTP sent successfully!']);
    }

    public function submitEnquiry(Request $request)
    {
        // If user is not logged in, verify OTP
        if (!auth()->check()) {
            if (session('otp') != $request->otp || session('otp_mobile') != $request->mobile) {
                return response()->json(['success' => false, 'message' => 'Invalid OTP']);
            }
        }

        // Save enquiry
        BusinessEnquiry::create([
            'business_id' => $request->business_id,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message,
        ]);

        // ✅ Increment total enquiries count for this business
        BusinessListing::where('id', $request->business_id)
            ->increment('total_enquiries');

        // Clear OTP after success (only for guests)
        if (!auth()->check()) {
            session()->forget(['otp', 'otp_mobile']);
        }

        return response()->json(['success' => true]);
    }


    public function sendOtp($mobile, $message)
    {
        // Fetch settings
        $authKey = env('SMS_AUTH_KEY', '133780APe3PZcx5850ea44');
        $sender = env('SMS_SENDER_ID', 'WMINGO');
        $peId = env('SMS_PE_ID', '1301160576431389865');

        $templateId = env('SMS_DLT_ID', '1307161465983326774');

        $request_parameter = [
            'authkey' => $authKey,
            'mobiles' => $mobile,
            'sender' => $sender,
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
        ];

        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach ($request_parameter as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }

        if ($templateId) {
            $url .= 'DLT_TE_ID=' . $templateId . '&';
        }
        if ($peId) {
            $url .= 'PE_ID=' . $peId . '&';
        }

        $url = rtrim($url, "&");

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Exception $e) {
            // dd($e->getMessage());
            \Log::error('SMS sending failed: ' . $e->getMessage());
            return false;
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $business = BusinessListing::findOrFail($id);
        $business->is_published = $request->is_published === 'true' ? true : false;
        $business->save();

        return response()->json([
            'status' => 200,
            'message' => 'Business status updated successfully!'
        ]);
    }


    public function ajaxDelete($id)
    {
        $business = BusinessListing::find($id);
        if (!$business) {
            return response()->json(['status' => 404, 'message' => 'Business not found']);
        }

        $business->delete();

        return response()->json(['status' => 200, 'message' => 'Business deleted successfully']);
    }


}
