<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concern\GlobalTrait;
use App\Models\ProfileSection;
use App\Notifications\GlobalNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AgentController extends Controller
{
	use GlobalTrait;

	public function index()
	{
		$agenst = User::where('role', 'agent')->orderBy('id', 'DESC')->get();
		return view('admin.agent.index', compact('agenst'));
	}

	public function create(Request $request)
	{
		$request->validate(
			[
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required|unique:users',
				'mobile_number' => 'required|unique:users',
				'gender' => 'required',
				'password' => 'required'
			]
		);

		try {
			$user = User::create(
				[
					'firstname' => $request->firstname,
					'lastname' => $request->lastname,
					'email' => $request->email,
					'mobile_number' => $request->mobile_number,
					'role' => 'agent',
					'gender' => $request->gender,
					'password' => \Hash::make($request->password)
				]
			);
			$sms = "Dear " . $user->firstname . " " . $user->lastname . " %0aYour Account Successfully Created, Login Credentials Are Given Below.%0a Login with ( Email/Mobile Number): " . $user->email . "/" . $user->mobile_number . "%0aPassword: " . $request->password;
			$sendOtp = $this->sendSMSInformtaion($user->mobile_number, $sms);
			$subject = "Registration Completed";
			$msg1 = "Your Account Successfully Created, Login Credentials Are Given Below.";
			$msg2 = "* Email/Mobile Number: " . $user->email . "/" . $user->mobile_number;
			$msg3 = "* Password: " . $request->password;
			$user->notify(new GlobalNotification($user, $subject, $msg1, $msg2, $msg3));
			return redirect()->back()->with('alert-success', 'Builder User created successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
		}
	}

	public function updateview($id)
	{
		$user = User::find($id);
		return view('admin.update_user_profile', compact('user'));
	}

	public function edit($id)
	{
		$user = User::find($id);
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
		return view('admin.agent.profile-section', compact('user', 'profileSection'));
	}

	public function update(Request $request, $id)
	{
			$user = User::find($id);

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
