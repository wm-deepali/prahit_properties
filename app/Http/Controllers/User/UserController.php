<?php

namespace App\Http\Controllers\User;

use App\AgentEnquiry;
use App\BusinessListing;
use App\Models\BusinessEnquiry;
use App\Models\Wishlist;
use Illuminate\Support\Carbon;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Concern\GlobalTrait;
use Illuminate\Http\Request;
use App\Properties;
use App\Category;
use App\State;
use App\User;
use App\Otp;
use Hash;
use Auth;
use App\Models\UserLoginHistory;
use App\Models\ProfileSection;
class UserController extends AppController
{
	use GlobalTrait;

	/*************
	 **
	 ** User's Login Function
	 **
	 **/


	public function login_ajax(Request $request)
	{
		if ($request->ajax()) {
			// OTP login
			if ($request->otp) {
				$picked_otp = Otp::where('otp', $request->otp)->first();
				if ($picked_otp) {
					$user = User::find($picked_otp->user_id);
					if ($user) {
						\Auth::login($user);
						$this->logUserLogin($user->id, $request, true);
						$picked_otp->delete();
						return response()->json(['status' => 200, 'message' => 'Login Successful', 'role' => $user->role]);
					} else {
						$this->logUserLogin(null, $request, false);
						return response()->json(['status' => 400, 'message' => 'User Not Found.']);
					}
				} else {
					$this->logUserLogin(null, $request, false);
					return response()->json(['status' => 400, 'message' => 'Invalid OTP, Please Enter Correctly.']);
				}
			}

			// Normal login (email or mobile)
			$type = $this->checkValidDatatype($request->email);
			if ($type == 'email') {
				$auth = \Auth::attempt(['email' => $request->email, 'password' => $request->password]);
			} else {
				$auth = \Auth::attempt(['mobile_number' => $request->email, 'password' => $request->password]);
			}

			try {
				if ($auth) {
					$user = \Auth::user();
					$this->logUserLogin($user->id, $request, true);

					return response()->json([
						'status' => 200,
						'message' => 'Login Successful',
						'role' => $user->role
					]);
				} else {
					// Log unsuccessful attempt
					$user = User::where('email', $request->email)
						->orWhere('mobile_number', $request->email)
						->first();

					$this->logUserLogin($user->id ?? null, $request, false);

					return response()->json(['status' => 400, 'message' => 'Invalid Credentials']);
				}
			} catch (\Exception $e) {
				$this->logUserLogin(null, $request, false);
				return response()->json(['status' => 500, 'error' => $e->getMessage()]);
			}
		}
	}


	private function logUserLogin($user_id, $request, $is_successful)
	{
		try {
			$ip = $request->ip();
			$agent = $request->header('User-Agent');

			UserLoginHistory::create([
				'user_id' => $user_id,
				'ip_address' => $ip,
				'device' => substr($agent, 0, 250),
				'browser' => $this->getBrowserName($agent),
				'is_successful' => $is_successful,
			]);
		} catch (\Exception $e) {
			\Log::error('User Login History Error: ' . $e->getMessage());
		}
	}

	private function getBrowserName($userAgent)
	{
		if (strpos($userAgent, 'Chrome') !== false)
			return 'Chrome';
		elseif (strpos($userAgent, 'Firefox') !== false)
			return 'Firefox';
		elseif (strpos($userAgent, 'Safari') !== false)
			return 'Safari';
		elseif (strpos($userAgent, 'Edge') !== false)
			return 'Edge';
		elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false)
			return 'Internet Explorer';
		return 'Other';
	}


	/*************
	 **
	 ** Owner Dashboard 
	 **
	 **/
	public function dashboard()
	{
		$userId = \Auth::id();

		// Properties
		$properties = Properties::where('user_id', $userId)->latest()->get();
		$totalProperties = $properties->count();
		$publishedProperties = $properties->where('publish_status', 'Publish')->count();
		$enquiredPropertyIds = AgentEnquiry::whereIn('property_id', $properties->pluck('id'))->distinct('property_id')->count();

		// Exclusive Properties
		$exclusiveCategory = Category::where('category_name', 'Exclusive Launch')->first();
		$ExclusiveProperties = Properties::when($exclusiveCategory, function ($query) use ($exclusiveCategory) {
			$query->where('category_id', $exclusiveCategory->id);
		})
			->latest()
			->take(3)
			->get();

		// Business Listings
		$businessListings = BusinessListing::where('user_id', $userId)->latest()->get();
		$totalBusiness = $businessListings->count();
		$publishedBusiness = $businessListings->where('is_published', true)->count();
		$enquiredBusiness = BusinessEnquiry::whereIn('business_id', $businessListings->pluck('id'))->distinct('business_id')->count();

		/* -------------------------------------
	PROPERTY TYPE (SUB SUB CATEGORY)
--------------------------------------*/
		$propertyTypes = Properties::where('user_id', $userId)
			->with(['SubSubCategory', 'SubCategory', 'Category'])
			->selectRaw('sub_sub_category_id, sub_category_id, category_id, COUNT(*) as total')
			->groupBy('sub_sub_category_id', 'sub_category_id', 'category_id')
			->get()
			->mapWithKeys(function ($item) {
				$name = $item->getCategoryHierarchyName() ?? 'Unknown';
				return [$name => $item->total];
			});

		$statusData = [
			'Pending' => Properties::where('user_id', $userId)
				->where('approval', 'Pending')
				->count(),

			'Approved' => Properties::where('user_id', $userId)
				->where('approval', 'Approved')
				->where('publish_status', 'Unpublish')
				->count(),

			'Published' => Properties::where('user_id', $userId)
				->where('publish_status', 'Publish')
				->count(),
		];
		return view('front.user.dashboard', compact(
			'properties',
			'ExclusiveProperties',
			'totalProperties',
			'publishedProperties',
			'enquiredPropertyIds',
			'businessListings',
			'totalBusiness',
			'publishedBusiness',
			'enquiredBusiness',
			'propertyTypes',
			'statusData'
		));

	}



	public function all_properties()
	{
		$userId = \Auth::id();

		// Get all user's properties with relationships
		$properties = Properties::with([
			'PropertyTypes',
			'PropertyGallery',
			'Category',
			'SubCategory',
			'SubSubCategory',
		])
			->where('user_id', $userId)
			->orderBy('id', 'DESC')
			->get();

		// Group them based on approval/publish status
		$pending = $properties->where('approval', 'Pending');
		$approved = $properties->where('approval', 'Approved');
		$published = $properties->where('publish_status', 'Publish');
		$rejected = $properties->where('approval', 'Rejected');

		return view('front.user.properties', compact('pending', 'approved', 'published', 'rejected'));
	}



	public function see_profile()
	{
		$states = State::where('country_id', 101)->get();
		$user = User::with('StateCity')->find(Auth::user()->id);
		// return $user;
		return view('front.user.profile', compact('states', 'user'));
	}

	public function update_profile(Request $request)
	{
		$request->validate(
			[
				"firstname" => "required",
				"lastname" => "required",
				"email" => "required|email",
				"mobile_number" => "required|numeric",
				"address" => "required",
				"state_id" => "required|numeric",
				"city_id" => "required|numeric"
			]
		);

		\Auth::user()->update($request->all());
		return redirect()->back()->with('alert-success', 'Profile Updated Successful.');
	}

	public function update_password(Request $request)
	{
		$request->validate(
			[
				"password" => "required",
				"new_password" => "required|same:confirm_new_password",
				"confirm_new_password" => "required"
			]
		);
		if (\Hash::check($request->password, \Auth::user()->password)) {
			\Auth::user()->fill([
				'password' => \Hash::make($request->new_password)
			])->save();
			$request->session()->flash('success', 'Password changed');
			return redirect()->back()->with('alert-success', 'Password Updated Successful.');
		} else {
			$request->session()->flash('error', 'Password does not match');
			return redirect()->back()->with('alert-warning', 'Old Password Does Not Matched Our Record, Please Try Again Later.');
		}
	}

	public function upload_avatar(Request $request)
	{
		// Validate request
		$request->validate([
			'user_id' => 'required|exists:users,id',
			'avatar_file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
		]);

		try {
			$user = User::find($request->user_id);

			// Delete old avatar if exists
			if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
				\Storage::disk('public')->delete($user->avatar);
			}

			// Store new avatar
			$path = $request->file('avatar_file')->store('uploads/avatar', 'public');

			// Save file path in DB
			$user->avatar = $path;
			$user->save();

			return response()->json([
				'status' => 200,
				'avatar_file' => asset('storage/' . $path)
			]);

		} catch (\Exception $e) {
			return response()->json([
				'status' => 500,
				'message' => $e->getMessage()
			]);
		}
	}


	public function userlogout(Request $request)
	{
		\Auth::logout();
		\Session::flush();
		return redirect('/');
	}

	public function allInquiries()
	{
		$user = Auth::user();

		// Get all enquiries for properties owned by this user
		$enquiries = AgentEnquiry::with([
			'Property.getCity',
			'Property.Category',
			'Property.SubCategory',
			'Property.SubSubCategory'
		])->whereHas('Property', function ($query) use ($user) {
			$query->where('user_id', $user->id);
		})
			->with(['Property', 'Interested'])
			->latest()
			->get();

		// Count stats
		$currentMonthCount = $enquiries->whereBetween('created_at', [
			Carbon::now()->startOfMonth(),
			Carbon::now()->endOfMonth()
		])->count();

		$lastMonthCount = $enquiries->whereBetween('created_at', [
			Carbon::now()->subMonth()->startOfMonth(),
			Carbon::now()->subMonth()->endOfMonth()
		])->count();

		$totalCount = $enquiries->count();

		return view('front.user.all-inquries', compact('enquiries', 'currentMonthCount', 'lastMonthCount', 'totalCount'));
	}

	public function myActivities()
	{
		$user = auth()->user();

		// 🩵 Wishlist count
		$wishlistCount = Wishlist::where('user_id', $user->id)->count();

		// 🩵 Contacted count (match by email or mobile)
		$contactedCount = AgentEnquiry::where(function ($q) use ($user) {
			$q->where('email', $user->email)
				->orWhere('mobile_number', $user->mobile_number);
		})->count();

		// 🩵 Viewed count (actual from property views)
		$viewedCount = \App\Models\PropertyView::where('user_id', $user->id)->count();

		// 🩵 Last login histories
		$lastSuccessfulLogin = UserLoginHistory::where('user_id', $user->id)
			->where('is_successful', true)
			->latest()
			->first();

		$lastUnsuccessfulLogin = UserLoginHistory::where('user_id', $user->id)
			->where('is_successful', false)
			->latest()
			->first();


		return view('front.user.my-activities', [
			'wishlistCount' => $wishlistCount,
			'contactedCount' => $contactedCount,
			'viewedCount' => $viewedCount,
			'lastSuccessfulLogin' => $lastSuccessfulLogin,
			'lastUnsuccessfulLogin' => $lastUnsuccessfulLogin,
		]);
	}


	public function recentViewedProperties()
	{
		$user = auth()->user();

		// Get last 20 viewed properties
		$recentViews = \App\Models\PropertyView::with('property')
			->where('user_id', $user->id)
			->orderBy('created_at', 'DESC')
			->limit(20)
			->get()
			->unique('property_id'); // Remove duplicates (only last view per property)

		return view('front.user.recent-viewed-properties', compact('recentViews'));
	}


	public function sentEnquiries()
	{
		$user = auth()->user();

		// Fetch enquiries where email or mobile matches logged-in user
		$enquiries = AgentEnquiry::with(['Property', 'Interested'])
			->where(function ($query) use ($user) {
				$query->where('email', $user->email)
					->orWhere('mobile_number', $user->mobile_number);
			})
			->latest()
			->get();

		// Count stats
		$currentMonthCount = $enquiries->whereBetween('created_at', [
			Carbon::now()->startOfMonth(),
			Carbon::now()->endOfMonth()
		])->count();

		$lastMonthCount = $enquiries->whereBetween('created_at', [
			Carbon::now()->subMonth()->startOfMonth(),
			Carbon::now()->subMonth()->endOfMonth()
		])->count();

		$totalCount = $enquiries->count();

		return view('front.user.sent-enquiries', compact('enquiries', 'currentMonthCount', 'lastMonthCount', 'totalCount'));
	}

	public function profileSection()
	{
		$user = Auth::user();

		if (!in_array($user->role, ['agent', 'builder'])) {
			abort(403, 'Unauthorized access.');
		}

		// Fetch or create profile section for the logged-in user
		$profileSection = ProfileSection::firstOrCreate(
			['user_id' => $user->id],
			[
				'business_name' => null,
				'rera_number' => null,
				'operating_since' => null,
				'years_experience' => null,
				'deals_in' => null,
				'description' => null,
				'services' => [],
				'address' => null,
				'phone' => null,
				'email' => null,
				'working_hours' => null,
				'logo' => null
			]
		);

		return view('front.user.profile-section', compact('user', 'profileSection'));
	}



	public function updateProfileSection(Request $request)
	{
		$user = Auth::user();

		if (!in_array($user->role, ['agent', 'builder'])) {
			abort(403, 'Unauthorized access.');
		}

		$request->validate([
			'business_name' => 'required|string|max:255',
			'rera_number' => 'nullable|string|max:255',
			'operating_since' => 'nullable|string|max:255',
			'years_experience' => 'nullable|integer|min:0',
			'deals_in' => 'nullable|string',
			'description' => 'nullable|string',
			'services' => 'nullable|array',
			'services.*.title' => 'nullable|string|max:255',
			'services.*.description' => 'nullable|string|max:500',
			'address' => 'nullable|string|max:500',
			'phone' => 'nullable|string|max:255',
			'email' => 'nullable|email|max:255',
			'working_hours' => 'nullable|array',
			'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // ✅ added
		]);

		$data = $request->only([
			'business_name',
			'rera_number',
			'operating_since',
			'years_experience',
			'deals_in',
			'description',
			'services',
			'address',
			'phone',
			'email',
			'working_hours'
		]);

		// ✅ Handle logo upload
		if ($request->hasFile('logo')) {
			$file = $request->file('logo');
			$data['logo'] = $file->store('uploads/profile_logos', 'public');
		}

		ProfileSection::updateOrCreate(['user_id' => $user->id], $data);

		return back()->with('success', 'Profile section updated successfully.');
	}



}

