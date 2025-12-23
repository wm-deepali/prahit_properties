<?php

namespace App\Http\Controllers;

use App\Otp;
use Auth;
use App\Job;
use App\Blog;
use App\User;
use App\City;
use App\State;
use Location;
use Exception;
use App\Amenity;
use App\Feature;
use App\Category;
use App\Feedback;
use App\Complaint;
use App\Locations;
use App\JobRequest;
use App\FormTypes;
use App\HelpContent;
use App\BlogCategory;
use App\ContactInfo;
use App\AgentEnquiry;
use App\Properties;
use App\SubCategory;
use App\Technology;
use App\Testimonial;
use App\JobCategory;
use App\EmailTemplate;
use App\SummonsReason;
use App\PropertyTypes;
use App\SubLocations;
use App\PropertyGallery;
use App\HomePageContent;
use App\BusinessListing;
use Illuminate\Http\Request;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Concern\GlobalTrait;
use Illuminate\Support\Str;
use App\Models\PriceLabel;
use App\Models\PropertyStatus;
use App\Models\FurnishingStatus;
use App\Models\RegistrationStatus;
use App\SubSubCategory;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Wishlist;
use App\Models\PropertyView;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class HomeController extends AppController
{

	use GlobalTrait;

	public function home(Request $request, $city = null)
	{
		try {
			$listings = Properties::with(['Category', 'Category.Subcategory', 'Location', 'PropertyTypes', 'PropertyGallery'])
				->where('approval', 'Approved')
				->where('publish_status', 'Publish');

			if ($request->input('category')) {
				$listings->where('category_id', decrypt($request->category));
			}

			if (is_null($city)) {
				$ip = \Request::ip();
				$location = Location::get($ip);
				$city = isset($location->cityName) ? strtolower($location->cityName) : 'Lucknow';
				$city_id = Cache::get('location-id');

				// Default redirect to city URL
				return redirect("/$city");
			} else {
				$picked_city = City::where('name', $city)->first();
				if ($picked_city) {
					Cache::flush();
					Cache::put('location-name', $picked_city->name);
					Cache::put('location-id', $picked_city->id);
					Cache::put('state-id', $picked_city->state_id);
					$listings->where('city_id', $picked_city->id);
				} else {
					$listings->where('city_id', null);
				}
			}

			// Fetch listings for the chosen city
			$listings = $listings->latest()->get();


			// If no listings found, show random approved and published properties
			if ($listings->isEmpty()) {
				$listings = Properties::with(['Category', 'Category.Subcategory', 'Location', 'PropertyTypes', 'PropertyGallery'])
					->where('approval', 'Approved')
					->where('publish_status', 'Publish')
					->inRandomOrder()
					->limit(10) // show any random 10 listings
					->get();
			}

			// Static content loading remains same
			$category = Category::all();
			$property_types = PropertyTypes::all();
			$feedback = Feedback::where('is_feedback', "1")->get();
			$testimonial = Testimonial::where('status', 'Yes')->where('show_on_front', 'Yes')->get();
			$features = Feature::where('status', 'Yes')->get();
			$help_content = HelpContent::first();

			return view('front.home', compact('listings', 'feedback', 'category', 'property_types', 'testimonial', 'features', 'help_content'));
		} catch (\Exception $e) {
			abort(500, $e->getMessage());
		}
	}

	public function requestCallback(Request $request)
	{
		$request->validate([
			'name' => 'required|max:150',
			'email' => 'required|email|max:200',
			'mobile_number' => 'required|digits:10',
			'message' => 'nullable|max:500',
		]);

		\App\Models\CallbackRequest::create([
			'name' => $request->name,
			'email' => $request->email,
			'mobile_number' => $request->mobile_number,
			'message' => $request->message,
		]);

		return redirect()->back()->with('success', 'Your request has been submitted. We will call you soon!');
	}

	public function list(Request $request)
	{
		$query = Properties::query();

		// Fixed filters: only approved and published properties
		$query->where('approval', 'Approved')
			->where('publish_status', 'Publish');

		// Normalize "type" to match category_name in DB
		$typeMap = [
			'buy' => 'Sell-6bspkyo',
			'rental' => 'Rent-qr3r6rf',
			'pg-hostels' => 'PG-Hostel-0lmf9h8',
			'exculsive-launch' => 'Exclusive-Launch',
			'plot-land' => 'Sell-6bspkyo'
		];

		$categoryName = $typeMap[$request->type] ?? null;
		$category = null;
		$subcategories = collect();
		$propertyTypes = collect();

		if ($categoryName) {
			$category = Category::where('category_slug', $categoryName)->first();

			if ($category) {
				$subcategories = $category->Subcategory()->get();
				$propertyTypes = \App\SubSubCategory::whereIn('sub_category_id', $subcategories->pluck('id'))->get();
				$query->where('category_id', $category->id);
			}
		}

		// Filter by sub_sub_category_id (property types)
		if ($request->filled('sub_sub_category_id')) {
			$propertyTypesFilter = is_array($request->sub_sub_category_id)
				? $request->sub_sub_category_id
				: explode(',', $request->sub_sub_category_id);
			// dd($propertyTypesFilter);
			$query->whereIn('sub_sub_category_id', $propertyTypesFilter);
		}

		// Filter by sub_category_id
		if ($request->filled('sub_category_id')) {
			$categoriesFilter = is_array($request->sub_category_id)
				? $request->sub_category_id
				: explode(',', $request->sub_category_id);
			$query->whereIn('sub_category_id', $categoriesFilter);
		}

		// Budget filters
		$sellBudgets = [
			'under-50-lakh' => [0, 5000000],
			'50-lakh-1-cr' => [5000001, 10000000],
			'1-cr-3-cr' => [10000001, 30000000],
			'3-cr-5-cr' => [30000001, 50000000],
			'above-5-cr' => [50000001, PHP_INT_MAX],
		];

		$rentBudgets = [
			'under-10k' => [0, 10000],
			'10k-25k' => [10001, 25000],
			'25k1-35k' => [25001, 35000],
			'35k1-50k' => [35001, 50000],
			'above-50k' => [50001, PHP_INT_MAX],
		];

		if ($request->filled('budget')) {
			$budgetKey = $request->budget;

			if (isset($sellBudgets[$budgetKey])) {
				[$minPrice, $maxPrice] = $sellBudgets[$budgetKey];
				$query->whereBetween('price', [$minPrice, $maxPrice]);
			} elseif (isset($rentBudgets[$budgetKey])) {
				[$minPrice, $maxPrice] = $rentBudgets[$budgetKey];
				$query->whereBetween('price', [$minPrice, $maxPrice]);
			}
		}

		// Filter by user role
		if ($request->filled('user_role')) {
			$query->whereHas('getUser', function ($q) use ($request) {
				$q->where('role', $request->user_role);
			});
		}

		// Filter by property_status
		if ($request->filled('property_status')) {
			$statuses = is_array($request->property_status)
				? $request->property_status
				: explode(',', $request->property_status);

			if (is_numeric($statuses[0])) {
				// IDs sent from front-end
				$query->whereIn('property_status', $statuses);
			} else {
				// Names sent from front-end
				$statusIds = PropertyStatus::whereIn('name', $statuses)->pluck('id');
				$query->whereIn('property_status', $statusIds);
			}
		}

		// Filter by furnishing_status
		if ($request->filled('furnishing_status')) {
			$statuses = is_array($request->furnishing_status)
				? $request->furnishing_status
				: explode(',', $request->furnishing_status);

			if (is_numeric($statuses[0])) {
				// IDs sent from front-end
				$query->whereIn('furnishing_status', $statuses);
			} else {
				// Names sent from front-end
				$statusIds = FurnishingStatus::whereIn('name', $statuses)->pluck('id');
				$query->whereIn('furnishing_status', $statusIds);
			}
		}

		if ($request->boolean('verified_property')) {
			$query->where(function ($q) {
				// Case 1: property itself is verified
				$q->where('verified', 'yes')
					// Case 2 & 3: owner is admin OR owner has active subscription with verified_tag = 'Yes'
					->orWhereHas('getUser', function ($qUser) {
						$qUser->where('role', 'admin') // owner is admin
							->orWhereHas('activePropertySubscription', function ($qSub) {
								$qSub->whereHas('package', function ($qPkg) {
									$qPkg->where('verified_tag', 'Yes');
								});
							});
					});
			});
		}


		// Only show properties that have at least one gallery image or a featured image
		if ($request->boolean('with_photos')) {
			$query->where(function ($q) {
				$q->whereNotNull('featured_image')
					->where('featured_image', '!=', '')
					->orWhereHas('PropertyGallery');
			});
		}

		// Filter by properties with videos
		if ($request->boolean('with_videos')) {
			$query->whereNotNull('property_video');
		}

		if ($request->filled('search')) {
			$search = trim($request->search);

			$query->where(function ($q) use ($search) {
				// Search only in more relevant columns to improve speed and relevance
				$q->where('title', 'like', "%{$search}%")
					->orWhere('description', 'like', "%{$search}%")
					->orWhere('address', 'like', "%{$search}%")
					->orWhereHas('Category', function ($cat) use ($search) {
						$cat->where('category_name', 'like', "%{$search}%");
					})
					->orWhereHas('getCity', function ($city) use ($search) {
						$city->where('name', 'like', "%{$search}%");
					});
			});
		}


		if ($request->filled('city')) {
			$query->whereHas('getCity', function ($q) use ($request) {
				$q->where('id', $request->city);
			});

			// Fetch locations only for the selected city
			$locations = Locations::where('status', 1)
				->where('city_id', $request->city)
				->orderBy('location', 'asc')
				->get();
		} else {
			// Fetch all active locations if no city is selected
			$locations = Locations::where('status', 1)
				->orderBy('location', 'asc')
				->get();
		}

		// Filter by status (verified)
		if ($request->filled('status')) {
			switch ($request->status) {
				case 'verified':
					$query->where('verified', 'yes');
					break;
				default:
					$query->latest();
			}
		}

		// Area filters (Carpet Area / Super Area)
		if ($request->filled('min_area') || $request->filled('max_area')) {
			$minArea = $request->min_area ?: 0;
			$maxArea = $request->max_area ?: PHP_INT_MAX;

			$query->where(function ($q) use ($minArea, $maxArea) {
				// Carpet Area
				$q->orWhere('additional_info', 'LIKE', "%\"Carpet Area\": \"$minArea\"%")
					->orWhere('additional_info', 'LIKE', "%\"Carpet Area\": \"$maxArea\"%");

				// Super Area
				$q->orWhere('additional_info', 'LIKE', "%\"Super Area\": \"$minArea\"%")
					->orWhere('additional_info', 'LIKE', "%\"Super Area\": \"$maxArea\"%");
			});
		}

		if ($request->filled('bedrooms')) {
			$bedrooms = $request->bedrooms;
			$query->where('additional_info', 'like', '%"label":"Bedroom"%')
				->where('additional_info', 'like', '%"userData":["' . $bedrooms . '"]%');
		}

		// Budget filter
		if ($request->filled('budget_min') || $request->filled('budget_max')) {
			$minPrice = $request->budget_min ?: 0;
			$maxPrice = $request->budget_max ?: PHP_INT_MAX;
			$query->whereBetween('price', [$minPrice, $maxPrice]);
		}

		if ($request->filled('locations')) {
			$locationIds = is_array($request->locations)
				? $request->locations
				: explode(',', $request->locations);

			$query->whereHas('Location', function ($q) use ($locationIds) {
				$q->whereIn('id', $locationIds);
			});
		}

		$sort = $request->get('sort', ''); // default empty


		switch ($sort) {
			case 'price-low':
				$query->orderBy('price', 'asc');
				break;

			case 'price-high':
				$query->orderBy('price', 'desc');
				break;

			case 'size-low':
				// Assuming 'Super Area' is the main size field
				$query->orderByRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(additional_info, '$.\"Super Area\"')) AS UNSIGNED) ASC");
				break;

			case 'size-high':
				$query->orderByRaw("CAST(JSON_UNQUOTE(JSON_EXTRACT(additional_info, '$.\"Super Area\"')) AS UNSIGNED) DESC");
				break;

			default:
				$query->latest(); // default sorting
		}

		if ($request->filled('price_negotiable')) {
			$value = $request->price_negotiable == 1 ? 'yes' : 'no';

			$query->whereRaw(
				"JSON_CONTAINS(additional_info, JSON_OBJECT('name', 'checkbox-group-1759836890188-0', 'userData', JSON_ARRAY(?)), '$')",
				[$value]
			);
		}


		// Filter by security_available
		if ($request->filled('security_available')) {
			$securityAvailable = $request->security_available; // 1 or 0
			$value = $securityAvailable == 1 ? 'yes' : 'no';
			// Correct JSON path
			$query->whereRaw(
				"JSON_CONTAINS(additional_info, JSON_OBJECT('name', 'radio-group-1760078870771-0', 'userData', JSON_ARRAY(?)), '$')",
				[$value]
			);
		}

		// Stepwise radius fallback search based on lat/lng
		if ($request->filled('latitude') && $request->filled('longitude')) {
			$lat = $request->latitude;
			$lng = $request->longitude;
			$radii = [5, 10, 25, 50, 200, 500];
			$foundProperties = null;

			foreach ($radii as $radius) {
				$tempQuery = clone $query;

				$haversine = "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))";

				$tempQuery->whereRaw("$haversine < ?", [$lat, $lng, $lat, $radius]);

				$foundProperties = $tempQuery->paginate(10);

				if ($foundProperties->count() > 0) {
					$query = $tempQuery;
					break;
				}
			}
		}

		// Pagination
		$properties = $query->paginate(10)->withQueryString();
		if ($request->ajax()) {
			// Return only the listing partial view (HTML of properties)
			return view('front.partials.property-listings', compact('properties'))->render();
		}

		// dd($subcategories);
		return view('front.listing-list', compact('properties', 'category', 'subcategories', 'propertyTypes', 'locations'));
	}

	public function directoryList(Request $request)
	{
		$query = BusinessListing::with(['category', 'subCategories', 'user.activeBusinessSubscription.package'])
			->where('status', 'Active')
			->where('is_published', true)
			->withAvg('reviews as average_rating', 'rating')      // ⭐ load avg rating
			->withCount('reviews as rating_count');               // ⭐ load total reviews

		// --- Filters ---

		if ($request->filled('subcategory')) {
			$subcategoryId = $request->subcategory;
			$query->whereHas('subCategories', function ($q) use ($subcategoryId) {
				$q->where('web_directory_sub_categories.id', $subcategoryId);
			});
		}

		if ($request->filled('category')) {
			$query->where('category_id', $request->category);
		}

		// ⭐ Filter by minimum rating (derived from reviews)
		if ($request->filled('rating')) {
			$query->having('average_rating', '>=', $request->rating);
		}
		// Filter by Verified (Package verified_badge)
		if ($request->verified == 'true') {
			$query->whereHas('user.activeBusinessSubscription.package', function ($q) {
				$q->where('verified_badge', 'Yes');
			});
		}

		// Filter by Premium (Package premium_badge)
		if ($request->premium == 'true') {
			$query->whereHas('user.activeBusinessSubscription.package', function ($q) {
				$q->where('premium_badge', 'Yes');
			});
		}

		// ⭐ Sort by most rated (review count)
		if ($request->most_rated == 'true') {
			$query->orderBy('rating_count', 'desc');
		}

		// Search
		if ($request->filled('search')) {
			$searchTerm = $request->search;
			$query->where(function ($q) use ($searchTerm) {
				$q->where('business_name', 'LIKE', "%{$searchTerm}%")
					->orWhere('introduction', 'LIKE', "%{$searchTerm}%")
					->orWhere('detail', 'LIKE', "%{$searchTerm}%");
			});
		}

		// ⭐ Sorting
		if (!$request->has('most_rated') || $request->most_rated != 'true') {
			$sortBy = $request->get('sort', 'default');

			switch ($sortBy) {
				case 'rating-high':
					$query->orderBy('average_rating', 'desc'); // ⭐ correct sorting
					break;

				case 'views-high':
					$query->orderBy('total_views', 'desc');
					break;

				case 'established-old':
					$query->orderBy('established_year', 'asc');
					break;

				case 'member-old':
					$query->orderBy('created_at', 'asc');
					break;

				default:
					$query->orderBy('id', 'desc');
			}
		}

		// --- Fetch all results ---
		$list = $query->get();

		// --- Sort by featured_in_top_provider (premium first) ---
		$list = $list->sortByDesc(function ($listing) {
			$package = $listing->user->activeBusinessSubscription?->package;
			return $package?->featured_in_top_provider === 'Yes' ? 1 : 0;
		});

		// --- Manual Pagination ---
		$perPage = 10;
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$currentItems = $list->slice(($currentPage - 1) * $perPage, $perPage)->values();

		$paginatedList = new \Illuminate\Pagination\LengthAwarePaginator(
			$currentItems,
			$list->count(),
			$perPage,
			$currentPage,
			['path' => $request->url(), 'query' => $request->query()]
		);

		$categories = \App\WebDirectoryCategory::with('subcategories')->get();

		if ($request->ajax()) {
			return view('front.partials.directory-items', ['list' => $paginatedList])->render();
		}

		return view('front.directory-listing', ['list' => $paginatedList, 'categories' => $categories]);
	}

	public function profilePage($slug = null)
	{
		// Find user by slug or fallback to logged-in user
		if ($slug) {
			$user = User::with('activePropertySubscription')->where('firstname', $slug)->first();
		} else {
			$user = auth()->check() ? auth()->user() : null;
		}

		if (!$user) {
			abort(404, 'User not found.');
		}

		// Property counts
		$totalProperties = Properties::where('user_id', $user->id)->count();
		$sellCount = Properties::where('user_id', $user->id)->where('category_id', 22)->count();
		$rentCount = Properties::where('user_id', $user->id)->where('category_id', 21)->count();
		$pgHostelCount = Properties::where('user_id', $user->id)->where('category_id', 20)->count();

		// Approved & published properties
		$properties = Properties::where('user_id', $user->id)
			->where('approval', 'Approved')
			->where('publish_status', 'Publish')
			->latest()
			->get();

		// Other Agents/Builders (exclude current user)
		$otherUsers = User::whereIn('role', ['agent', 'builder'])
			->where('id', "!=", $user->id)
			->whereHas('profileSection')
			->with('profileSection')
			->take(3)
			->get();

		if (in_array($user->role, ['agent', 'builder'])) {
			// Fetch Profile Section Data only for agents/builders
			$profileSection = \App\Models\ProfileSection::where('user_id', $user->id)->first();

			return view('front.profile-page', compact(
				'user',
				'slug',
				'profileSection',
				'totalProperties',
				'sellCount',
				'rentCount',
				'pgHostelCount',
				'properties',
				'otherUsers'
			));
		} else {
			// For other users, same data but without profile section
			return view('front.owner-profile', compact(
				'user',
				'slug',
				'totalProperties',
				'sellCount',
				'rentCount',
				'pgHostelCount',
				'properties',
				'otherUsers'
			));
		}
	}

	public function businessDetails($id)
	{
		$business = BusinessListing::with([
			'category',
			'subCategories',
			'services',
			'propertyCategories',
			'propertySubCategories',
			'propertySubSubCategories',
			'user.activeBusinessSubscription.package', // eager load subscription + package
			'portfolio',
			'workingHours',
		])->findOrFail($id);

		// Increment views count
		$business->increment('total_views');

		// Fetch other service providers (excluding current business owner)
		$relatedProviders = BusinessListing::where('user_id', '!=', $business->user_id)
			->with('user.activeBusinessSubscription.package') // also include badge info for related providers
			->limit(5)
			->get();

		return view('front.business-details', compact('business', 'relatedProviders'));
	}

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
		$price_labels = PriceLabel::where('status', 'active')->get();
		$property_statuses = PropertyStatus::where('status', 'active')->get();
		$registration_statuses = RegistrationStatus::where('status', 'active')->get();
		$furnishing_statuses = FurnishingStatus::where('status', 'active')->get();

		return view('front.create_property', compact(
			'category',
			'locations',
			'form_type',
			'states',
			'amenities',
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses',
			'photos_per_listing',
			'video_upload'
		));
	}

	public function property_detail($id, $slug)
	{
		$property = Properties::with([
			'Location',
			'PropertyGallery',
			'PropertyFeatures',
			'PropertyFeatures.SubFeatures',
			'PropertyTypes',
			'getState',
			'getCity',
			'getUser',
			'Category',
			'SubCategory',
			'SubSubCategory',
		])
			->where('slug', $slug)
			->where('id', $id)
			->firstOrFail();

		$property_detail = $property;
		$property_user = User::find($property->user_id);

		$amenities = $property->amenities
			? Amenity::whereIn('id', explode(',', $property->amenities))->get()
			: collect();

		// recently viewed
		$user = Auth::user();
		if ($user) {
			PropertyView::updateOrCreate(
				['user_id' => $user->id, 'property_id' => $property->id],
				['ip_address' => request()->ip(), 'updated_at' => now()]
			);
		}

		$property->increment('total_views');

		$isInWishlist = $user
			? Wishlist::where('user_id', $user->id)
				->where('property_id', $property->id)
				->exists()
			: false;

		/* 🔑 MAIN LOGIC (USES YOUR MODEL DIRECTLY) */
		$categorySlug = optional($property->Category)->category_name;
		$subSubSlug = optional($property->SubSubCategory)->sub_sub_category_name;

		$categorySlug = $categorySlug ? Str::slug($categorySlug) : null;
		$subSubSlug = $subSubSlug ? Str::slug($subSubSlug) : null;

		$viewKey = $categorySlug . '_' . $subSubSlug;
		$detailSection = config(
			'property_detail_sections.' . $viewKey,
			'front.property_sections.default'
		);

		$features = [];
		if ($property_detail->additional_info) {
			foreach (json_decode($property_detail->additional_info, true) as $field) {

				if (in_array($field['type'], ['header', 'paragraph'])) {
					continue;
				}

				if (!empty($field['label']) && !empty($field['userData'])) {

					// 🔹 Clean label
					$cleanLabel = html_entity_decode($field['label']);
					$cleanLabel = strip_tags($cleanLabel);
					$cleanLabel = preg_replace('/\s+/u', ' ', $cleanLabel);
					$cleanLabel = trim($cleanLabel);

					// 🔹 Handle single vs multiple values
					if (is_array($field['userData'])) {
						$features[$cleanLabel] = implode(', ', array_filter($field['userData']));
					} else {
						$features[$cleanLabel] = $field['userData'];
					}
				}

			}
		}

		// dd($viewKey, $features);

		return view('front.property_detail', compact(
			'property_detail',
			'amenities',
			'isInWishlist',
			'property_user',
			'detailSection',
			'features'
		));
	}


	public function search_property(Request $request)
	{
		try {
			$location = $request->input('property');
			$type = $request->input('type');
			$min_price = $request->input('min_price');
			$max_price = $request->input('max_price');
			$states = State::where('name', 'LIKE', '%' . $location . '%')->get();
			$cities = City::where('name', 'LIKE', '%' . $location . '%')->get();
			$locations = Locations::where('location', 'LIKE', '%' . $location . '%')->get();
			$ids = [];
			$property = Properties::with([
				'PropertyTypes',
				'PropertyGallery',
				'Category',
				'Category.SubCategory',
				'Location',
				'getUser'
			]);
			if (count($states) > 0 && count($cities) == 0 && count($locations) == 0) {
				foreach ($states as $state) {
					array_push($ids, $state->id);
				}
				$property = $property->whereIn('state_id', $ids);
			} else if (count($states) == 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			} else if (count($states) > 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			} else if (count($states) == 0 && count($cities) > 0 && count($locations) > 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			} else if (count($states) == 0 && count($cities) == 0 && count($locations) > 0) {
				$property_ids = [];
				$get_properties = Properties::where('approval', 'Approved')->get();
				foreach ($get_properties as $p) {
					foreach ($locations as $location) {
						if (in_array($location->id, explode(',', $p->location_id))) {
							array_push($property_ids, $p->id);
						}
					}
				}
				$property = $property->whereIn('id', $property_ids);
			} else {
				$property = $property->whereIn('state_id', []);
			}
			$properties = $property->where('type_id', $type)
				->where('price', '>', $min_price)
				->where('price', '<', $max_price)
				->where('approval', 'Approved')
				->where('publish_status', 'Publish')
				->paginate(10);
			$categories = Category::all();
			$location_datas = Locations::all();
			return view('front.search', compact('categories', 'location_datas', 'properties'));
		} catch (\Exception $e) {
			abort(500, $e->getMessage());
		}
	}

	public function searchPropertyGrid(Request $request)
	{
		try {
			$location = $request->input('property');
			$type = $request->input('type');
			$min_price = $request->input('min_price');
			$max_price = $request->input('max_price');
			$states = State::where('name', 'LIKE', '%' . $location . '%')->get();
			$cities = City::where('name', 'LIKE', '%' . $location . '%')->get();
			$locations = Locations::where('location', 'LIKE', '%' . $location . '%')->get();
			$ids = [];
			$property = Properties::with([
				'PropertyTypes',
				'PropertyGallery',
				'Category',
				'Category.SubCategory',
				'Location',
				'getUser'
			]);
			if (count($states) > 0 && count($cities) == 0 && count($locations) == 0) {
				foreach ($states as $state) {
					array_push($ids, $state->id);
				}
				$property = $property->whereIn('state_id', $ids);
			} else if (count($states) == 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			} else if (count($states) > 0 && count($cities) > 0 && count($locations) == 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			} else if (count($states) == 0 && count($cities) > 0 && count($locations) > 0) {
				foreach ($cities as $city) {
					array_push($ids, $city->id);
				}
				$property = $property->whereIn('city_id', $ids);

			} else if (count($states) == 0 && count($cities) == 0 && count($locations) > 0) {
				$property_ids = [];
				$get_properties = Properties::where('approval', 'Approved')->get();
				foreach ($get_properties as $p) {
					foreach ($locations as $location) {
						if (in_array($location->id, explode(',', $p->location_id))) {
							array_push($property_ids, $p->id);
						}
					}
				}
				$property = $property->whereIn('id', $property_ids);
			} else {
				$property = $property->whereIn('state_id', []);
			}
			$properties = $property->where('type_id', $type)
				->where('price', '>', $min_price)
				->where('price', '<', $max_price)
				->where('approval', 'Approved')
				->where('publish_status', 'Publish')
				->paginate(10);
			$categories = Category::all();
			$location_datas = Locations::all();
			return view('front.search_grid', compact('categories', 'location_datas', 'properties'));
		} catch (\Exception $e) {
			abort(500, $e->getMessage());
		}
	}

	public function createProperty(Request $request)
	{
		try {
			$request->validate([
				'title' => 'required|max:200',
				'price' => 'required|numeric',
				'category_id' => 'required',
				'description' => 'required',
				'address' => 'required',
				'location_id' => 'required',
				'custom_location_input' => 'nullable|string|max:255',
				'sub_location_id' => 'nullable|array',
				'sub_location_id.*' => 'nullable|string',
				'firstname' => 'required|string|max:100',
				'lastname' => 'required|string|max:100',
				'email' => 'required|email',
				'mobile_number' => 'required|digits:10',
				'otp' => 'nullable',
				'gallery_images_file.*' => 'required|mimes:jpg,png,jpeg',
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
		// 1️⃣ CHECK OTP IF USER IS NOT VERIFIED OR NUMBER CHANGED
		// ---------------------------------------------------
		$loggedUser = auth()->user();
		$isVerified = $loggedUser ? $loggedUser->is_verified : false;
		$mobileChanged = $loggedUser && $request->mobile_number != $loggedUser->mobile_number;

		// OTP required when user is unverified OR mobile changed
		if (!$isVerified || $mobileChanged) {
			if (empty($request->otp)) {
				return response()->json([
					'success' => false,
					'message' => 'OTP is required.',
				], 422);
			}

			$otp_check = Otp::where('otp', $request->otp)->first();
			if (!$otp_check) {
				return response()->json([
					'success' => false,
					'message' => 'Invalid or expired OTP.',
				], 400);
			}

			// ✔ Only verify user if MOBILE IS SAME and USER WAS NOT VERIFIED
			if (!$isVerified && !$mobileChanged) {
				$loggedUser->is_verified = 1;  // verify user
				$loggedUser->save();
			}

			// Delete OTP after use
			$otp_check->delete();
		}

		// ---------------------------------------------------
		// 3️⃣ CREATE PROPERTY
		// ---------------------------------------------------

		$user_id = $loggedUser ? $loggedUser->id : null;
		$count = Properties::count();
		$unique_id = 'PP-' . str_pad($count, 4, '0', STR_PAD_LEFT);
		$slug = str_replace('/', '-', str_replace(' ', '-', $request->title));

		// ----------------------------------------------------------
		//  LOCATION
		// ----------------------------------------------------------
		$locationId = $request->location_id;
		if ($locationId === 'other') {
			$customLocationName = trim($request->custom_location_input);
			if (!empty($customLocationName)) {
				$customLocationName = ucwords(strtolower($customLocationName));
				$newLocation = Locations::create([
					'state_id' => $request->state,
					'city_id' => $request->city,
					'location' => $customLocationName,
					'status' => 1,
				]);
				$locationId = $newLocation->id;
			} else {
				return response()->json([
					'status' => 'error',
					'message' => 'Please enter the custom location name.',
				], 422);
			}
		}

		// ----------------------------------------------------------
		//  SUB LOCATIONS
		// ----------------------------------------------------------
		$submittedSubLocations = $request->input('sub_location_id', []);
		$resolvedSubLocationIds = [];

		if (!empty($submittedSubLocations)) {
			foreach ($submittedSubLocations as $value) {

				$value = trim($value ?? '');

				if ($value === '')
					continue;

				if (ctype_digit($value)) {
					$existing = SubLocations::find((int) $value);
					if ($existing)
						$resolvedSubLocationIds[] = $existing->id;
				} else {
					$name = ucwords(strtolower($value));
					$dup = SubLocations::where('location_id', $locationId)
						->where('sub_location_name', $name)
						->first();

					if ($dup) {
						$resolvedSubLocationIds[] = $dup->id;
					} else {
						$newSub = SubLocations::create([
							'location_id' => $locationId,
							'sub_location_name' => $name,
						]);
						$resolvedSubLocationIds[] = $newSub->id;
					}
				}
			}
		}

		$normalizedSubLocationId = !empty($resolvedSubLocationIds)
			? implode(',', $resolvedSubLocationIds)
			: null;


		// ✅ Convert checkbox arrays
		$price_label = $request->has('price_label') ? implode(',', (array) $request->price_label) : null;
		$property_status = $request->has('property_status') ? implode(',', (array) $request->property_status) : null;
		$registration_status = $request->has('registration_status') ? implode(',', (array) $request->registration_status) : null;
		$furnishing_status = $request->has('furnishing_status') ? implode(',', (array) $request->furnishing_status) : null;
		$amenities = $request->has('amenity') ? implode(',', (array) $request->amenity) : null;

		// ✅ Create property
		$property = Properties::create([
			'user_id' => $user_id,
			'title' => $request->title,
			'listing_id' => $unique_id,
			'slug' => $slug,
			'price' => $request->price,
			'price_label' => $price_label,
			'price_label_second' => $request->price_label_second,
			'property_status' => $property_status,
			'property_status_second' => $request->property_status_second,
			'registration_status' => $registration_status,
			'registration_status_second' => $request->registration_status_second,
			'furnishing_status' => $furnishing_status,
			'furnishing_status_second' => $request->furnishing_status_second,
			'description' => $request->description,
			'category_id' => $request->category_id,
			'sub_category_id' => $request->sub_category_id,
			'sub_sub_category_id' => $request->sub_sub_category_id,
			'address' => $request->address,
			'state_id' => $request->state,
			'city_id' => $request->city,
			'location_id' => $locationId,
			'sub_location_id' => $normalizedSubLocationId,
			'amenities' => $amenities,
			'latitude' => $request->latitude,
			'longitude' => $request->longitude,
			'additional_info' => $request->form_json,

			// Store owner details per property
			'owner_firstname' => $request->firstname,
			'owner_lastname' => $request->lastname,
			'owner_email' => $request->email,
			'owner_mobile' => $request->mobile_number,
		]);

		// ---------------------------------------------------
		// 4️⃣ GALLERY UPLOAD
		// ---------------------------------------------------
		if ($request->has('gallery_images_file')) {
			$gallery_images = $this->multipleFileUpload($request, [
				'uploads/properties/gallery_images/' => 'gallery_images_file'
			]);

			foreach ($gallery_images as $img) {
				PropertyGallery::create([
					'property_id' => $property->id,
					'image_path' => $img,
				]);
			}
		}

		// ---------------------------------------------------
		// 5️⃣ VIDEO UPLOAD
		// ---------------------------------------------------
		if ($request->hasFile('property_video')) {
			$file = $request->file('property_video');
			$filename = uniqid('video_') . '.' . $file->getClientOriginalExtension();
			$path = $file->storeAs('uploads/properties/videos', $filename, 'public');
			$property->property_video = 'storage/' . $path;
			$property->save();
		}

		// ---------------------------------------------------
// 6️⃣ UPDATE USED LISTINGS IN ACTIVE SUBSCRIPTION
// ---------------------------------------------------
		$activePropertySubscription = $property->getUser->activePropertySubscription;

		if ($activePropertySubscription) {
			$activePropertySubscription->used_listings += 1;
			$activePropertySubscription->save();
		}


		// ---------------------------------------------------
		// 6️⃣ RESPONSE
		// ---------------------------------------------------
		return response()->json([
			'success' => true,
			'message' => 'Property Posted Successfully.',
			'redirect_url' => url('user/property/preview/' . $property->id),
		]);
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

		$price_labels = Cache::remember('price_labels_active', 3600, function () {
			return PriceLabel::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
				->get();
		});

		$property_statuses = Cache::remember('property_statuses_active', 3600, function () {
			return PropertyStatus::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
				->get();
		});

		$registration_statuses = Cache::remember('registration_statuses_active', 3600, function () {
			return RegistrationStatus::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
				->get();
		});

		$furnishing_statuses = Cache::remember('furnishing_statuses_active', 3600, function () {
			return FurnishingStatus::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
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
			->select('id', 'image_path')
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
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses',
			'photos_per_listing',
			'video_upload'
		));
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

		$price_labels = Cache::remember('price_labels_active', 3600, function () {
			return PriceLabel::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
				->get();
		});

		$property_statuses = Cache::remember('property_statuses_active', 3600, function () {
			return PropertyStatus::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
				->get();
		});

		$registration_statuses = Cache::remember('registration_statuses_active', 3600, function () {
			return RegistrationStatus::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
				->get();
		});

		$furnishing_statuses = Cache::remember('furnishing_statuses_active', 3600, function () {
			return FurnishingStatus::where('status', 'active')
				->select('id', 'name', 'input_format', 'second_input_label')
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
			->select('id', 'image_path')
			->get();

		$sub_categories = SubCategory::where('category_id', $property->category_id)
			->select('id', 'sub_category_name')
			->get();

		$sub_sub_categories = SubSubCategory::where('sub_category_id', $property->sub_category_id)
			->select('id', 'sub_sub_category_name', )
			->get();

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
			'amenities',
			'id',
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses',
			'photos_per_listing',
			'video_upload'
		));
	}

	public function updateProperty(Request $request)
	{
		try {
			// ------------------------------
			//  VALIDATION
			// ------------------------------
			$request->validate([
				'title' => 'required|max:200',
				'price' => 'required|numeric',
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
		//  OTP VALIDATION — ONLY IF MOBILE IS CHANGED
		// ----------------------------------------------------------
		$originalMobile = $picked->owner_mobile ?? auth()->user()->mobile_number;
		$newMobile = $request->mobile_number;

		if ($newMobile != $originalMobile) {

			// OTP must be entered
			if (!$request->otp_code || strlen($request->otp_code) < 4) {
				return response()->json([
					'success' => false,
					'message' => 'OTP is required to update mobile number.'
				], 422);
			}

			// Compare with session OTP
			if (session('property_otp') != $request->otp_code) {
				return response()->json([
					'success' => false,
					'message' => 'Invalid OTP. Please try again.'
				], 422);
			}
		}

		// ----------------------------------------------------------
		//  CONVERT CHECKBOX ARRAYS
		// ----------------------------------------------------------
		$price_label = $request->has('price_label') ? implode(',', (array) $request->price_label) : null;
		$property_status = $request->has('property_status') ? implode(',', (array) $request->property_status) : null;
		$registration_status = $request->has('registration_status') ? implode(',', (array) $request->registration_status) : null;
		$furnishing_status = $request->has('furnishing_status') ? implode(',', (array) $request->furnishing_status) : null;

		// ----------------------------------------------------------
		//  CUSTOM LOCATION HANDLING
		// ----------------------------------------------------------
		$locationId = $request->location_id;

		if ($locationId === 'other') {
			$customLocationName = trim($request->custom_location_input);
			if (empty($customLocationName)) {
				return response()->json(['success' => false, 'message' => 'Please enter the custom location name.'], 422);
			}

			$newLocation = \App\Locations::create([
				'state_id' => $request->state,
				'city_id' => $request->city,
				'location' => ucwords(strtolower($customLocationName)),
				'status' => 1,
			]);

			$locationId = $newLocation->id;
		}

		// ----------------------------------------------------------
		//  SUB LOCATIONS
		// ----------------------------------------------------------
		$submittedSubLocations = $request->input('sub_location_id', []);
		$resolvedSubLocationIds = [];

		if (!empty($submittedSubLocations)) {
			foreach ($submittedSubLocations as $value) {

				$value = trim($value ?? '');

				if ($value === '')
					continue;

				if (ctype_digit($value)) {
					$existing = SubLocations::find((int) $value);
					if ($existing)
						$resolvedSubLocationIds[] = $existing->id;
				} else {
					$name = ucwords(strtolower($value));
					$dup = SubLocations::where('location_id', $locationId)
						->where('sub_location_name', $name)
						->first();

					if ($dup) {
						$resolvedSubLocationIds[] = $dup->id;
					} else {
						$newSub = SubLocations::create([
							'location_id' => $locationId,
							'sub_location_name' => $name,
						]);
						$resolvedSubLocationIds[] = $newSub->id;
					}
				}
			}
		}

		$normalizedSubLocationId = !empty($resolvedSubLocationIds)
			? implode(',', $resolvedSubLocationIds)
			: null;

		// ----------------------------------------------------------
		//  UPDATE PROPERTY
		// ----------------------------------------------------------
		$picked->update([
			'title' => $request->title,
			'price' => $request->price,
			'price_label' => $price_label,
			'price_label_second' => $request->price_label_second,
			'property_status' => $property_status,
			'property_status_second' => $request->property_status_second,
			'registration_status' => $registration_status,
			'registration_status_second' => $request->registration_status_second,
			'furnishing_status' => $furnishing_status,
			'furnishing_status_second' => $request->furnishing_status_second,
			'description' => $request->description,

			'category_id' => $request->category_id,
			'sub_category_id' => $request->sub_category_id,
			'sub_sub_category_id' => $request->sub_sub_category_id,

			'address' => $request->address,
			'state_id' => $request->state,
			'city_id' => $request->city,
			'location_id' => $locationId,
			'sub_location_id' => $normalizedSubLocationId,

			'amenities' => $request->has('amenity') ? implode(',', (array) $request->amenity) : null,
			'additional_info' => $request->form_json,
			'latitude' => $request->latitude,
			'longitude' => $request->longitude,

			// ----------------------------------------------------------
			//  🟢 OWNER INFO UPDATE
			// ----------------------------------------------------------
			'owner_firstname' => $request->firstname,
			'owner_lastname' => $request->lastname,
			'owner_email' => $request->email,
			'owner_mobile' => $request->mobile_number,
		]);

		// ----------------------------------------------------------
		//  VIDEO UPLOAD
		// ----------------------------------------------------------
		if ($request->hasFile('property_video')) {

			if ($picked->property_video && file_exists(public_path($picked->property_video))) {
				@unlink(public_path($picked->property_video));
			}

			$video = $request->file('property_video');
			$videoName = time() . '_' . preg_replace('/\s+/', '_', $video->getClientOriginalName());
			$videoPath = 'uploads/properties/videos/';
			$video->move(public_path($videoPath), $videoName);

			$picked->property_video = $videoPath . $videoName;
			$picked->save();
		}

		// ----------------------------------------------------------
		//  GALLERY IMAGES
		// ----------------------------------------------------------
		if ($request->hasFile('gallery_images_file')) {
			foreach ($request->file('gallery_images_file') as $file) {

				$imageName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
				$filePath = 'uploads/properties/gallery_images/';
				$file->move(public_path($filePath), $imageName);

				PropertyGallery::create([
					'property_id' => $picked->id,
					'image_path' => $filePath . $imageName,
				]);
			}
		}

		// ----------------------------------------------------------
		//  RESPONSE
		// ----------------------------------------------------------
		return response()->json([
			'success' => true,
			'message' => 'Property updated successfully.',
			'redirect_url' => $request->from
				? url('user/property/preview/' . $picked->id)
				: url('user/properties'),
			'property_id' => $picked->id,
		]);
	}



	public function deleteGalleryImages(Request $request)
	{
		$picked = PropertyGallery::find($request->id);
		$this->imageDeleteFromFolder('uploads/properties/gallery_images/', $picked->image_path);
		$picked->delete();
		return 'Image Deleted Successfully.';
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


	public function sendAgentEnquiryOtp(Request $request)
	{
		$otp = rand(1000, 9999);

		// Store OTP temporarily
		session([
			'agent_otp' => $otp,
			'agent_otp_mobile' => $request->mobile_number,
		]);

		// Simulate sending SMS (replace with actual SMS API)
		$message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
		$response = $this->sendOtp($request->mobile_number, $message);
		if (!$response) {
			return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
		}

		return response()->json(['success' => true, 'message' => 'OTP sent successfully!']);
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

	public function agent_enquiry(Request $request)
	{
		$rules = [
			"property_id" => "required",
			"name" => "required",
			"email" => "required|email",
			"mobile_number" => "required|numeric",
			"interested_in" => "required",
		];
		$this->checkValidate($request, $rules);
		// dd($request->all());
		// 🟡 For guests, verify OTP
		if (!auth()->check()) {
			if (
				session('agent_otp') != $request->otp ||
				session('agent_otp_mobile') != $request->mobile_number
			) {
				return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
			}
		}

		try {
			AgentEnquiry::create($request->all());

			// ✅ Clear OTP after success (for guests)
			if (!auth()->check()) {
				session()->forget(['agent_otp', 'agent_otp_mobile']);
			}

			return response()->json(['success' => true, 'message' => 'Your enquiry has been submitted successfully.']);
		} catch (\Exception $e) {
			return response()->json(['success' => false, 'message' => $e->getMessage()]);
		}
	}


	public function aboutUs()
	{
		$about = HomePageContent::where('slug', 'about')->first();
		$vision = HomePageContent::where('slug', 'vision')->first();
		$keys = HomePageContent::where('slug', 'vision-keys')->get();
		return view('front.about_us', compact('about', 'vision', 'keys'));
	}

	public function termCondition()
	{
		$term = HomePageContent::where('slug', 'terms')->first();
		return view('front.terms', compact('term'));
	}

	public function privecyPolicy()
	{
		$policy = HomePageContent::where('slug', 'policy')->first();
		return view('front.policy', compact('policy'));
	}

	public function contactUs()
	{
		$infos = ContactInfo::get();
		$map_link = HomePageContent::where('slug', 'map-link')->first();
		return view('front.contact_us', compact('infos', 'map_link'));
	}

	public function testimonial()
	{
		$picked = HomePageContent::where('slug', 'testimonial')->first();
		$testimonials = Testimonial::where('status', 'Yes')->get();
		return view('front.testimonial', compact('testimonials', 'picked'));
	}

	public function safetyHealth()
	{
		$picked = HomePageContent::where('slug', 'safety')->first();
		return view('front.safety-guide', compact('picked'));
	}

	public function summonsNotice()
	{
		$reasons = SummonsReason::get();
		return view('front.summons-notice', compact('reasons'));
	}

	public function sendSummonsNotice(Request $request)
	{
		$request->validate(
			[
				'name' => 'required|max:200',
				'email' => 'required|max:200|email',
				'phone_number' => 'required|max:200',
				'link' => 'nullable|url',
				'file' => 'nullable|mimes:jpg,png,jpeg,svg,pdf|max:2000',
			]
		);
		$reasons = $request->has('reason') ? implode(',', $request->reason) : null;
		if ($request->hasFile('file')) {
			$path = $request->file->store('complaints');
		} else {
			$path = null;
		}
		Complaint::create(
			[
				'name' => $request->name,
				'email' => $request->email,
				'mobile_number' => $request->phone_number,
				'link' => $request->link,
				'reasons' => $reasons,
				'other' => $request->has('other') ? 'Yes' : 'No',
				'other_reason' => $request->other_reason,
				'message' => $request->message,
				'file' => $path
			]
		);
		return redirect()->back()->with('success', 'Your Complaint successfully send, please wait for our response.');
	}

	public function careerWithUs()
	{
		$picked = HomePageContent::where('slug', 'career')->first();
		$categories = JobCategory::with('getRealatedJobs')->where('status', 'Yes')->get();
		return view('front.career-with-us', compact('picked', 'categories'));
	}

	public function jobdetail($id)
	{
		$job = Job::find($id);
		$skills = Technology::whereIn('id', explode(',', $job->skills))->get();
		$related_jobs = Job::where('category_id', $job->category_id)->whereNotIn('id', [$job->id])->get();
		return view('front.job-detail', compact('job', 'skills', 'related_jobs'));
	}

	public function sendJobRequest(Request $request)
	{
		$request->validate(
			[
				'name' => 'required|max:150',
				'email' => 'required|email',
				'mobile_number' => 'required|digits:10',
				'file' => 'required|mimes:pdf|max:2000'
			]
		);
		if ($request->hasFile('file')) {
			$path = $request->file->store('resume');
		}
		JobRequest::create(
			[
				'job_id' => $request->job_id,
				'name' => $request->name,
				'email' => $request->email,
				'mobile_number' => $request->mobile_number,
				'resume' => $path
			]
		);
		return redirect()->back()->with('success', 'Your Query Successfully Submitted, Please Wait For Our Response.');
	}

	public function blog()
	{
		$featured = Blog::where('featured', 'Yes')->get();
		$blog_categories = BlogCategory::where('status', 'Yes')->get();
		return view('front.blog', compact('featured', 'blog_categories'));
	}

	public function blogDetail($id)
	{
		$blog_detail = Blog::find($id);
		$related_blogs = Blog::where('category_id', $blog_detail->category_id)->whereNotIn('id', [$blog_detail->id])->where('status', 'Yes')->get();
		return view('front.blog-detail', compact('blog_detail', 'related_blogs'));
	}

	public function createTestimonial(Request $request)
	{
		$request->validate(
			[
				'name' => 'required|max:200',
				'email' => 'required|email',
				'designation' => 'required|max:200',
				'description' => 'required',
				'image' => 'required|mimes:jpg,png,jpeg|max:200'
			]
		);
		if ($request->hasFile('image')) {
			$path = $request->image->store('testimonials');
		} else {
			$path = null;
		}
		Testimonial::create(
			[
				'name' => $request->name,
				'email' => $request->email,
				'mobile_number' => $request->mobile_number,
				'image' => $path,
				'designation' => $request->designation,
				'description' => $request->description
			]
		);
		return redirect()->back()->with('success', 'Your Feedback Successfully Submitted.');
	}

	public function getCities(Request $request)
	{
		$cities = City::where('state_id', $request->state_id)->get();
		return $cities;
	}

	public function getLocations(Request $request)
	{
		$locations = Locations::where('city_id', $request->city_id)->get();
		return $locations;
	}

	public function getSubLocations(Request $request)
	{
		$sub_locations = SubLocations::where('location_id', $request->location_id)->get();
		return $sub_locations;
	}

	public function getAllCities(Request $request)
	{
		$states = State::where('country_id', 101)->orderBy('name', 'ASC')->get();
		$cities = City::where('state_id', $request->input('state_id'))->orderBy('name', 'ASC')->paginate(500);
		return view('layouts.front.cities-modal', compact('cities', 'states'))->render();
	}

	public function getAllCitiesAncher(Request $request)
	{
		if ($request->input('search')) {
			$cities = City::where('name', 'LIKE', "%$request->search%")->where('state_id', $request->input('state_id'))->orderBy('name', 'ASC')->paginate(100);
		} else {
			$cities = City::where('state_id', $request->input('state_id'))->orderBy('name', 'ASC')->paginate(100);
		}
		return view('layouts.front.cities-ancher', compact('cities'))->render();
	}

	public function autoSearch(Request $request)
	{
		$search = $request->input('query');
		$data = City::select("id", "name")
			->where("name", "LIKE", '%' . $search . '%')
			->orderby('name', 'asc')
			->get();
		return response()->json($data);
	}

	public function getSubCategories($category_id)
	{
		try {
			$findSubCategories = SubCategory::where('category_id', $category_id)->get();
			$data['status'] = 200;
			$data['subcategories'] = $findSubCategories;
			return $data;
		} catch (\Exception $e) {
			$data['status'] = 500;
			$data['subcategories'] = $e->getMessage();
			return $data;
		}
	}

	public function getSubSubcategories($id)
	{
		$subSubCategories = SubSubCategory::where('sub_category_id', $id)->get();
		return response()->json(['subsubcategories' => $subSubCategories]);
	}

	public function userVerifyEmail()
	{
		$otp = rand(100000, 999999);
		Otp::create(
			[
				'otp' => $otp,
				'user_id' => \Auth::id()
			]
		);
		$emailOTPtemplate = EmailTemplate::where('id', 7)->first();
		$replaceOTPtemplate = array(
			'#NAME' => \Auth::user()->firstname . ' ' . \Auth::user()->lastname,
			'#OTP' => $otp
		);
		$this->__sendEmail(\Auth::user(), $emailOTPtemplate->template, $emailOTPtemplate->subject, $emailOTPtemplate->image, $replaceOTPtemplate);
		return 'OTP Successfully Send On Your Registered Email Id.';
	}

	public function userVerifyMobile()
	{
		$otp = rand(100000, 999999);
		Otp::create(
			[
				'otp' => $otp,
				'user_id' => \Auth::id()
			]
		);
		$message = "Your one time password is  " . $otp . " %0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
		$this->sendGlobalSMS(\Auth::user()->mobile_number, $message);
		return 'OTP Successfully Send On Your Registered Mobile Number.';
	}

	public function emailMobileOtpVerification(Request $request)
	{
		$picked = \Auth::user();
		$otp = Otp::where('otp', $request->otp)->first();
		if (!$otp) {
			return redirect()->back()->with('error', 'Invalid OTP, Please Enter Correct OTP.');
		}
		if ($otp->user_id != \Auth::id()) {
			return redirect()->back()->with('error', 'Invalid User.');
		}
		$msg = '';
		if ($request->input('type') == 'email') {
			$status = '1';
			$msg = 'Email Verified Successfully.';
			$picked->update(
				[
					'is_verified' => $status
				]
			);
		} else if ($request->input('type') == 'mobile') {
			$status = '1';
			$msg = 'Mobile Number Verified Successfully.';
			$picked->update(
				[
					'mobile_verified' => $status
				]
			);
		}
		$otp->delete();
		return redirect()->back()->with('success', $msg);
	}

	public function cookiesPolicy()
	{
		return view('front.cookies_policy');
	}

	public function cancellationPolicy()
	{
		return view('front.cancellation_policy');
	}

	public function faq()
	{

		// Fetch all FAQs with their category
		$faqs = Faq::with('category')->get();

		// Optionally, fetch categories if needed for filtering/display
		$categories = FaqCategory::where('status', 'Published')->get();

		return view('front.faq', compact('faqs', 'categories'));
	}


	public function faqCategory($slug)
	{
		$category = FaqCategory::where('slug', $slug)->firstOrFail();

		$faqs = Faq::where('status', 'Published')
			->where('category_id', $category->id)
			->latest()
			->get();

		$categories = FaqCategory::where('status', 'Published')
			->where('id', "!=", $category->id)
			->get();

		return view('front.faq-category', compact('category', 'faqs', 'categories'));
	}

	public function adertisementPolicy()
	{
		return view('front.adertisement_policy');
	}

	public function agentProperties()
	{
		return view('front.agent_properties');
	}

	public function builderProperties()
	{
		return view('front.builder_properties');
	}

	public function builderProfile()
	{
		return view('front.builder_profile');
	}

}

