<?php

namespace App\Http\Controllers\Admin;

use App\BusinessListing;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\GlobalNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Properties;
use App\State;
use App\User;
use App\City;

class OwnersController extends Controller
{
	use GlobalTrait;

	public function index()
	{
		$owners = User::where('role', 'owner')->orderBy('id', 'DESC')->get();
		return view('admin.owners.index', compact('owners'));
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
					'role' => 'owner',
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
		$states = State::where('country_id', 101)->get();
		$cities = City::where('state_id', $user->state_id)->get();
		return view('admin.update_user_profile', compact('user', 'states', 'cities'));
	}

	public function viewUserProfile($id)
	{
		$user = User::find($id);

		if (!$user) {
			return redirect()->back()->with('error', 'User not found.');
		}

		$properties = Properties::where('user_id', $user->id)->get();

		// Get business listings for this user (if you allow multiple)
		$businessListings = BusinessListing::where('user_id', $user->id)
			->with(['category', 'subCategories', 'services'])
			->get();

		return view('admin.user_view_profile', compact('user', 'properties', 'businessListings'));
	}


	public function verifyEmailMobile(Request $request)
	{
		$picked = User::find($request->id);
		$msg;
		if ($request->type == 'email') {
			$status = $picked->is_verified == '1' ? '0' : '1';
			$msg = $picked->is_verified == '1' ? 'Email Unverified Successfully.' : 'Email Verified Successfully.';
			$picked->update(
				[
					'is_verified' => $status
				]
			);
		} else if ($request->type == 'mobile') {
			$status = $picked->mobile_verified == '1' ? '0' : '1';
			$msg = $picked->mobile_verified == '1' ? 'Mobile Number Unverified Successfully.' : 'Mobile Number Verified Successfully.';
			$picked->update(
				[
					'mobile_verified' => $status
				]
			);
		}
		return $msg;
	}
}
