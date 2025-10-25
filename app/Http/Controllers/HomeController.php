<?php

namespace App\Http\Controllers;

use Http;
use App\Otp;
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
use App\Notifications\WelcomeEmailNotification;
use App\Models\PriceLabel;
use App\Models\PropertyStatus;
use App\Models\FurnishingStatus;
use App\Models\RegistrationStatus;
use App\SubSubCategory;
use App\Models\Faq;
use App\Models\FaqCategory;

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
			$query->where('sub_category_id', $request->sub_category_id);
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


		// Search query for title or location
		if ($request->filled('search')) {
			$search = $request->search;
			$query->where(function ($q) use ($search) {
				$q->where('title', 'like', "%{$search}%")
					->orWhereHas('Location', function ($q2) use ($search) {
						$q2->where('location', 'like', "%{$search}%");
					});
			});
		}

		// Filter by city
		if ($request->filled('city')) {
			$query->whereHas('getCity', function ($q) use ($request) {
				$q->where('id', $request->city);
			});
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

		// Sorting
		if ($request->filled('sort')) {
			switch ($request->sort) {
				case 'new-launch':
					$query->orderBy('published_date', 'desc');
					break;
				case 'price-low-high':
					$query->orderBy('price', 'asc');
					break;
				case 'price-high-low':
					$query->orderBy('price', 'desc');
					break;
				default:
					$query->latest();
			}
		} else {
			$query->latest(); // default order
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


		// Budget filter
		if ($request->filled('budget_min') || $request->filled('budget_max')) {
			$minPrice = $request->budget_min ?: 0;
			$maxPrice = $request->budget_max ?: PHP_INT_MAX;
			$query->whereBetween('price', [$minPrice, $maxPrice]);
		}


		// Pagination
		$properties = $query->paginate(10)->withQueryString();
		// dd($subcategories);
		return view('front.listing-list', compact('properties', 'category', 'subcategories', 'propertyTypes'));
	}


	public function directoryList(Request $request)
	{
		$query = BusinessListing::query()->where('status', 'Active');

		// 🔹 Filter by Web Directory Subcategory
		if ($request->has('subcategory') && !empty($request->subcategory)) {
			$subcategoryId = $request->subcategory;

			$query->whereHas('subCategories', function ($q) use ($subcategoryId) {
				$q->where('web_directory_sub_categories.id', $subcategoryId);
			});
		}

		$list = $query->paginate(10);

		return view('front.directory-listing', compact('list'));
	}


	public function create_property()
	{
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
		));
	}


	public function property_detail($slug)
	{
		$property = Properties::with([
			'Location',
			'PropertyGallery',
			'PropertyFeatures',
			'PropertyFeatures',
			'PropertyFeatures.SubFeatures',
			'PropertyTypes',
			'getState',
			'getCity'
		])->where('slug', $slug)->first();
		$property_detail = $property;
		$amenities = Amenity::whereIn('id', explode(',', $property_detail->amenities))->get();
		return view('front.property_detail', compact('property_detail', 'amenities'));
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
		// dd($request->all());
		$request->validate([
			'title' => 'required|max:200',
			'type_id' => 'nullable',
			'price' => 'required|numeric',
			'price_label.*' => 'nullable',
			'category_id' => 'required',
			'sub_category_id' => 'required',
			'construction_age' => 'nullable',
			'description' => 'required',
			'address' => 'required',
			'location_id' => 'required',
			'owner_type' => 'required',
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email',
			'mobile_number' => 'required|numeric|digits:10',
			'otp' => 'required',
			"gallery_images_file.*" => 'required|mimes:jpg,png,jpeg',
			'sub_location_name' => 'nullable|string|max:255',
		]);

		// Check OTP first
		$otp_check = Otp::where('otp', $request->otp)->first();
		if (!$otp_check) {
			return back()->withErrors(['OTP Failed', 'Otp does not exist or may be expired.']);
		}

		$otp_check->delete();

		// Check if user already exists
		$user = User::where('email', $request->email)
			->orWhere('mobile_number', $request->mobile_number)
			->first();

		if (!$user) {
			// Determine role based on owner_type
			switch ($request->owner_type) {
				case 1:
					$role = 'owner';
					break;
				case 2:
					$role = 'builder';
					break;
				case 3:
					$role = 'agent';
					break;
				default:
					$role = 'owner';
					break;
			}


			$pass = rand(10000, 99999);
			$show_pass = $pass;

			// Validate uniqueness if creating new user
			$request->validate([
				'email' => 'required|unique:users,email',
				'mobile_number' => 'required|unique:users,mobile_number'
			]);

			$user = User::create([
				'role' => $role,
				'firstname' => $request->firstname,
				'lastname' => $request->lastname,
				'email' => $request->email,
				'mobile_number' => $request->mobile_number,
				'address' => $request->address,
				'state_id' => $request->state_id,
				'city_id' => $request->city_id,
				'password' => \Hash::make($pass)
			]);

			// Send SMS
			$sms = "Dear {$user->firstname} {$user->lastname}%0aThank you for joining with us, your login password is {$pass}%0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
			$this->sendSMSInformtaion($user->mobile_number, $sms);

			// Send Email
			try {
				$emailtemplate = EmailTemplate::where('id', 1)->first();
				$ordertemplate = $emailtemplate->template;
				$replacetemplate = [
					'#NAME' => $user->firstname . ' ' . $user->lastname,
					'#EMAIL' => $user->email,
					'#PASSWORD' => $show_pass,
				];
				foreach ($replacetemplate as $key => $val) {
					$ordertemplate = str_replace($key, $val, $ordertemplate);
				}
				$user->notify(new WelcomeEmailNotification($ordertemplate, $emailtemplate->subject, $emailtemplate->image));
			} catch (\Exception $e) {
				return redirect()->back()->with('error', $e->getMessage());
			}
		}

		// Prepare property data
		$count = Properties::count();
		$unique_id = 'PP-' . str_pad($count, 4, '0', STR_PAD_LEFT);
		$slug = str_replace('/', '-', str_replace(' ', '-', $request->title));

		$property = Properties::create([
			'user_id' => $user->id,
			'title' => $request->title,
			'listing_id' => $unique_id,
			'slug' => $slug,
			'type_id' => $request->type_id,
			'price' => $request->price,
			'price_label' => is_array($request->price_label) ? implode(',', $request->price_label) : $request->price_label,
			'price_label_second' => $request->price_label_second ?? null,
			'property_status' => is_array($request->property_status) ? implode(',', $request->property_status) : $request->property_status,
			'property_status_second' => $request->property_status_second ?? null,
			'registration_status' => is_array($request->registration_status) ? implode(',', $request->registration_status) : $request->registration_status,
			'registration_status_second' => $request->registration_status_second ?? null,
			'furnishing_status' => is_array($request->furnishing_status) ? implode(',', $request->furnishing_status) : $request->furnishing_status,
			'furnishing_status_second' => $request->furnishing_status_second ?? null,
			'description' => $request->description,
			'category_id' => $request->category_id,
			'sub_category_id' => $request->sub_category_id,
			'sub_sub_category_id' => $request->sub_sub_category_id,
			'address' => $request->address,
			'state_id' => $request->state,
			'city_id' => $request->city,
			'location_id' => implode(',', $request->location_id),
			'sub_location_name' => $request->sub_location_name ?? null,
			'amenities' => $request->amenity ? implode(',', $request->amenity) : null,
			'additional_info' => $request->form_json,
			'construction_age' => $request->construction_age
		]);

		// Handle gallery images
		if ($request->has('gallery_images_file')) {
			$gallery_images = $this->multipleFileUpload($request, ['uploads/properties/gallery_images/' => 'gallery_images_file']);
			foreach ($gallery_images as $image) {
				PropertyGallery::create(['property_id' => $property->id, 'image_path' => $image]);
			}
		}

		return redirect('user/property/preview/' . $property->id)->with('success', 'Property Posted Successfully.');
	}


	public function editPropertyView($id)
	{
		$category = Category::all();
		$locations = Locations::all();
		$form_type = FormTypes::with('FormTypesFields', 'FormTypesFields.SubFeatures')->where('id', 1)->get();
		$property = Properties::find($id);
		$states = State::where('country_id', 101)->get();
		$cities = City::where('state_id', $property->state_id)->get();
		$locations = Locations::where('city_id', $property->city_id)->get();
		$sub_locations = SubLocations::whereIn('location_id', explode(',', $property->location_id))->get();
		$property_images = PropertyGallery::where('property_id', $id)->get();
		$subcategories = SubCategory::where('category_id', $property->category_id)->get();
		$amenities = Amenity::where('status', 'Yes')->get();

		// Get all active Price Labels and Statuses
		$price_labels = PriceLabel::where('status', 'active')->get();
		$property_statuses = PropertyStatus::where('status', 'active')->get();
		$registration_statuses = RegistrationStatus::where('status', 'active')->get();
		$furnishing_statuses = FurnishingStatus::where('status', 'active')->get();

		return view('front.edit_property', compact(
			'category',
			'locations',
			'form_type',
			'states',
			'cities',
			'locations',
			'sub_locations',
			'property',
			'property_images',
			'subcategories',
			'amenities',
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses'
		));
	}

	public function userPreviewPropertyView($id)
	{
		$category = Category::all();
		$locations = Locations::all();
		$form_type = FormTypes::with('FormTypesFields', 'FormTypesFields.SubFeatures')->where('id', 1)->get();
		$property = Properties::find($id);
		$states = State::where('country_id', 101)->get();
		$cities = City::where('state_id', $property->state_id)->get();
		$locations = Locations::where('city_id', $property->city_id)->get();
		$sub_locations = SubLocations::whereIn('location_id', explode(',', $property->location_id))->get();
		$property_images = PropertyGallery::where('property_id', $id)->get();
		$subcategories = SubCategory::where('category_id', $property->category_id)->get();
		$amenities = Amenity::where('status', 'Yes')->get();

		// Get all active Price Labels and Statuses
		$price_labels = PriceLabel::where('status', 'active')->get();
		$property_statuses = PropertyStatus::where('status', 'active')->get();
		$registration_statuses = RegistrationStatus::where('status', 'active')->get();
		$furnishing_statuses = FurnishingStatus::where('status', 'active')->get();

		return view('front.preview_property', compact(
			'category',
			'locations',
			'form_type',
			'states',
			'cities',
			'locations',
			'sub_locations',
			'property',
			'property_images',
			'subcategories',
			'amenities',
			'id',
			'price_labels',
			'property_statuses',
			'registration_statuses',
			'furnishing_statuses'
		));
	}

	public function updateProperty(Request $request)
	{
		$request->validate([
			'title' => 'required|max:200',
			'type_id' => 'nullable',
			'price' => 'required|numeric',
			'price_label.*' => 'nullable',
			'category_id' => 'required',
			'sub_category_id' => 'required',
			'construction_age' => 'nullable',
			'description' => 'required',
			'address' => 'required',
			'location_id' => 'required',
			'sub_location_name' => 'nullable|string|max:255',
			"gallery_images_file.*" => 'nullable|mimes:jpg,png,jpeg',
		]);

		$picked = Properties::findOrFail($request->id);

		// Handle comma-separated fields (checkboxes)
		$price_label = $request->has('price_label') ? implode(',', (array) $request->price_label) : null;
		$property_status = $request->has('property_status') ? implode(',', (array) $request->property_status) : null;
		$registration_status = $request->has('registration_status') ? implode(',', (array) $request->registration_status) : null;
		$furnishing_status = $request->has('furnishing_status') ? implode(',', (array) $request->furnishing_status) : null;

		$picked->update([
			'title' => $request->title,
			'type_id' => $request->type_id,
			'price' => $request->price,
			'price_label' => $price_label,
			'price_label_second' => $request->price_label_second, // new field
			'property_status' => $property_status,
			'property_status_second' => $request->property_status_second, // new field
			'registration_status' => $registration_status,
			'registration_status_second' => $request->registration_status_second, // new field
			'furnishing_status' => $furnishing_status,
			'furnishing_status_second' => $request->furnishing_status_second, // new field
			'description' => $request->description,
			'category_id' => $request->category_id,
			'sub_category_id' => $request->sub_category_id,
			'sub_sub_category_id' => $request->sub_sub_category_id,
			'address' => $request->address,
			'state_id' => $request->state,
			'city_id' => $request->city,
			'location_id' => implode(',', (array) $request->location_id),
			'sub_location_name' => $request->sub_location_name ?? null,
			'amenities' => $request->has('amenity') ? implode(',', (array) $request->amenity) : null,
			'additional_info' => $request->form_json,
			'construction_age' => $request->construction_age,
		]);

		// Handle gallery images upload
		if ($request->has('gallery_images_file')) {
			$gallery_images = $this->multipleFileUpload($request, [
				'uploads/properties/gallery_images/' => 'gallery_images_file'
			]);
			foreach ($gallery_images as $value) {
				PropertyGallery::create([
					'property_id' => $picked->id,
					'image_path' => $value
				]);
			}
		}

		// Redirect based on role
		if ($request->from) {
			return redirect('user/property/preview/' . $picked->id);
		}

		switch (\Auth::user()->role) {
			case 'owner':
				return redirect('user/properties')->with('success', 'Property Content Updated Successfully.');
			case 'builder':
				return redirect('builder/properties')->with('success', 'Property Content Updated Successfully.');
			case 'agent':
				return redirect('agent/properties')->with('success', 'Property Content Updated Successfully.');
		}
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

	public function agent_enquiry(Request $request)
	{
		$rules = [
			"property_id" => "required",
			"name" => "required",
			"email" => "required|email",
			"mobile_number" => "required|numeric",
			"interested_in" => "required"
		];
		$this->checkValidate($request, $rules);

		try {
			$claim = AgentEnquiry::create($request->all());
			return redirect()->back()->with('alert-success', 'Your Query Successfully Submitted.');
		} catch (\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
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

	public function sendLoginOtp(Request $request)
	{
		$check_input_type = $this->checkValidLoginType($request->email);
		if ($check_input_type == 'email') {
			$picked = User::where('email', $request->email)->first();
		} else if ($check_input_type == 'mobile') {
			$picked = User::where('mobile_number', $request->email)->first();
		}
		if (!$picked) {
			$data['status'] = 500;
			$data['data'] = null;
			$data['msg'] = 'User not exist, for this email or mobile number';
			return $data;
		}
		$otp = rand(100000, 999999);
		Otp::create(
			[
				'otp' => $otp,
				'user_id' => $picked->id
			]
		);
		$emailOTPtemplate = EmailTemplate::where('id', 4)->first();
		$replaceOTPtemplate = array(
			'#NAME' => $picked->firstname . ' ' . $picked->lastname,
			'#OTP' => $otp
		);
		$this->__sendEmail($picked, $emailOTPtemplate->template, $emailOTPtemplate->subject, $emailOTPtemplate->image, $replaceOTPtemplate);
		// Send SMS
		$message = "Your one time password is  " . $otp . " %0aThank You.,%0aWeb Mingo IT Solutions Pvt. Ltd.%0aVisit: https://www.webmingo.in%0aWhatsApp: 7499366724";
		$this->sendGlobalSMS($picked->mobile_number, $message);
		$data['status'] = 200;
		$data['data'] = null;
		$data['msg'] = 'OTP Successfully Send On User Email & Mobile Number.';
		return $data;
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

