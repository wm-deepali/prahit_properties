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

