<?php

namespace App\Http\Controllers\Api;

use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use App\Notifications\WelcomeEmailNotification;
use App\Notifications\SendOtpEmailNotification;
use App\Http\Controllers\Concern\GlobalTrait;
use Illuminate\Support\Facades\Validator;
use App\Notifications\GlobalNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\EmailTemplate;
use App\Properties;
use App\LoginLogs;
use App\User;
use App\Otp;


class AuthController extends BaseApiController
{
	use GlobalTrait;

	public function login(Request $request)
	{
		$rules = [
			'email' => "required",
			'password' => 'required'
		];
		$this->checkValidate($request, $rules);

		// if(Auth::attempt(['email' => $request->email])) {
		$user = User::where('email', $request->email)->first();
		if (isset($user)) {
			// $user = User::find(Auth::user()->id);
			if (Hash::check($request->password, $user->password)) {
				if ($user->is_verified == "0") {
					$this->_sendErrorResponse(400, 'Please verify your account to continue.');
				} else {
					$user->auth_token = $this->_generateToken();
					$this->_sendResponse(['User' => $user], 'Login successful');
				}
			} else {
				$this->_sendErrorResponse(400, 'Incorrect password');
			}
		} else {
			$this->_sendErrorResponse(400, 'User not found');
		}
	}

	public function register(Request $request)
	{
		$rules = [
			'firstname' => "required",
			'lastname' => 'required',
			'email' => 'required|unique:users',
			'mobile_number' => 'required|min:10|unique:users',
			'state_id' => 'required|numeric',
			'city_id' => 'required|numeric',
			'password' => 'required|min:8',
			'confirm_password' => 'required|same:password|min:8'
		];

		$this->checkValidate($request, $rules);

		try {
			if ($request->owner_type == 1) {
				$request['role'] = 'owner';
			} else if ($request->owner_type == 2) {
				$request['role'] = 'builder';
			} else if ($request->owner_type == 3) {
				$request['role'] = 'agent';
			} else if ($request->owner_type == 4) {
				$request['role'] = 'service_provider';
			}

			$show_pass = $request->password;
			$request['name'] = "$request->firstname $request->lastname";
			$request['password'] = Hash::make($request->password);
			$request['auth_token'] = $this->_generateToken();
			$otp = rand(1000, 4999);
			$request['otp'] = $otp;

			// Check if email already exists
			$picked = User::where('email', $request->email)->first();
			if ($picked) {
				return response()->json([
					'status' => false,
					'message' => 'Email already exists in our record.'
				], 400);
			}

			$user = User::create($request->all());

			if ($user->exists()) {

				// Create or update OTP record in `otps` table
				Otp::updateOrCreate(
					['user_id' => $user->id],
					[
						'otp' => $otp,
					]
				);

				// Send OTP
				$message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
				$sendOtp = \App\Helpers\Helper::sendOtp($request->mobile_number, $message);

				// Email templates
				$emailtemplate = EmailTemplate::find(1);
				$emailOTPtemplate = EmailTemplate::find(4);

				// Welcome email
				$ordertemplate = $emailtemplate->template;
				$replacetemplate = [
					'#NAME' => $user->firstname . ' ' . $user->lastname,
					'#EMAIL' => $user->email,
					'#PASSWORD' => $show_pass,
				];
				foreach ($replacetemplate as $key => $val) {
					$ordertemplate = str_replace($key, $val, $ordertemplate);
				}
				$finaltemplate = $ordertemplate;

				// OTP email
				$otp_template = $emailOTPtemplate->template;
				$replaceOTPtemplate = [
					'#NAME' => $user->firstname . ' ' . $user->lastname,
					'#OTP' => $otp
				];
				foreach ($replaceOTPtemplate as $key => $val) {
					$otp_template = str_replace($key, $val, $otp_template);
				}
				$finalotptemplate = $otp_template;

				// Send notifications
				// $user->notify(new WelcomeEmailNotification($finaltemplate, $emailtemplate->subject, $emailtemplate->image));
				// $user->notify(new SendOtpEmailNotification($finalotptemplate, $emailOTPtemplate->subject, $emailOTPtemplate->image));

				if ($sendOtp) {
					return response()->json([
						'status' => true,
						'message' => 'OTP generated successfully and sent on your registered email & mobile number.',
						'data' => $user
					], 200);
				} else {
					return response()->json([
						'status' => false,
						'message' => 'OTP could not be sent.'
					], 400);
				}
			} else {
				return response()->json([
					'status' => false,
					'message' => 'An error occurred while creating the user.'
				], 400);
			}

		} catch (\Exception $e) {
			return response()->json([
				'status' => false,
				'message' => $e->getMessage()
			], 500);
		}
	}


	public function verifyOTP(Request $request)
	{
		$rules = [
			'otp' => 'required|numeric',
			'user_id' => 'required'
		];

		$this->checkValidate($request, $rules);

		try {
			$user = User::find($request->user_id);

			if (!$user) {
				return response()->json([
					'status' => false,
					'message' => 'User not found.'
				], 404);
			}

			// --- Case 1: OTP Verification during Registration ---
			if ($request->is_register) {
				if ($user->is_verified == "1") {
					return response()->json([
						'status' => false,
						'message' => 'OTP is already verified.'
					], 400);
				}

				// Find OTP record
				$otpRecord = Otp::where(['otp' => $request->otp, 'user_id' => $user->id])->first();

				if (!$otpRecord) {
					return response()->json([
						'status' => false,
						'message' => "Invalid or expired OTP."
					], 400);
				}

				// Update user verification status
				$user->is_verified = "1";
				$user->otp = null; // optional: clear otp field if stored in users table
				$user->save();

				// Delete OTP record
				$otpRecord->delete();

				return response()->json([
					'status' => true,
					'message' => 'OTP verified successfully.',
					'data' => $user
				], 200);
			}

			// --- Case 2: Forgot Password / OTP for Reset ---
			else {
				// Validate OTP
				// dd('here');
				$otpRecord = Otp::where(['otp' => $request->otp, 'user_id' => $user->id])->first();

				if (!$otpRecord) {
					return response()->json([
						'status' => false,
						'message' => 'Invalid or expired OTP.'
					], 400);
				}

				if (empty($request->new_password)) {
					return response()->json([
						'status' => false,
						'message' => 'New password is required.'
					], 400);
				}

				// Update password
				$user->password = Hash::make($request->new_password);
				$user->otp = null; // optional
				$user->save();

				// Delete OTP record
				$otpRecord->delete();

				return response()->json([
					'status' => true,
					'message' => 'Password updated successfully.',
					'data' => $user
				], 200);
			}
		} catch (\Exception $e) {
			return response()->json([
				'status' => false,
				'message' => $e->getMessage()
			], 500);
		}
	}


	public function forgotPassword(Request $request)
	{
		// Validate input
		$request->validate([
			'mobile_number' => 'required'
		]);

		try {
			// Find user by mobile number
			$user = User::where('mobile_number', $request->mobile_number)->first();

			if (empty($user)) {
				return response()->json([
					'status' => 400,
					'message' => 'Mobile number not registered'
				], 400);
			}

			$otp = rand(1000, 4999);

			Otp::updateOrCreate(
				['user_id' => $user->id],
				[
					'otp' => $otp,
				]
			);

			// Send OTP
			$message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
			$sendOtp = \App\Helpers\Helper::sendOtp($request->mobile_number, $message);

			if ($sendOtp) {
				return response()->json([
					'status' => true,
					'message' => 'OTP generated successfully and sent on your registered email & mobile number.',
					'data' => $user
				], 200);
			} else {
				return response()->json([
					'status' => false,
					'message' => 'OTP could not be sent.'
				], 400);
			}

		} catch (\Exception $e) {
			return response()->json([
				'status' => 500,
				'message' => 'Something went wrong: ' . $e->getMessage()
			], 500);
		}
	}


	public function resetPassword(Request $request)
	{
		$rules = [
			'email' => 'required',
			'password' => 'required|min:8',
			'confirm_password' => 'required|same:password'
		];
		$this->checkValidate($request, $rules);

		try {
			$user = User::where('email', $request->email)->first();
			$new_password = Hash::make($request->password);
			$user->password = $new_password;
			if ($user->save()) {
				$this->_sendResponse(['User' => $user], 'Password updated successfully');
			} else {
				$this->_sendErrorResponse(400, 'An error occured.');
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, 'An error occured.');
		}

	}


	public function change_password(Request $request)
	{
		$rules = [
			'old_password' => 'required',
			'new_password' => 'required',
			'confirm_password' => 'required'
		];
		$this->checkValidate($request, $rules);

		try {
			$user_token = $request->get('users');

			$check_password = Hash::check($request->old_password, $user_token->password);
			if ($check_password) {
				$user = User::where('auth_token', $user_token->auth_token)->first();
				$user->password = Hash::make($request->new_password);
				$user->save();
				$this->_sendResponse(['User' => $user], 'Password updated successfully');
			} else {
				$this->_sendErrorResponse(400, 'Current password is incorrect');
			}

		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function update_profile(Request $request)
	{
		$rules = [
			"firstname" => "required",
			"lastname" => "required",
			"email" => "required|email",
			"mobile_number" => "required|numeric",
			"address" => "required",
			"state_id" => "required|numeric",
			"city_id" => "required|numeric"
		];
		$this->checkValidate($request, $rules);

		try {
			$user_token = $request->get('users');
			$user = User::findOrFail($user_token->id);
			if ($user->update($request->all())) {
				$this->_sendResponse([], 'Profile updated successfully');
			} else {
				$this->_sendErrorResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, 'An error occured');
		}

	}


}

