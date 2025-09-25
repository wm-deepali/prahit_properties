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


class AuthController extends BaseApiController {
	use GlobalTrait;

	public function login(Request $request) {
		$rules = [
			'email' => "required",
			'password' => 'required'
		];
		$this->checkValidate($request, $rules);

		// if(Auth::attempt(['email' => $request->email])) {
		$user = User::where('email', $request->email)->first();
		if(isset($user)) {
			// $user = User::find(Auth::user()->id);
			if(Hash::check($request->password, $user->password)) {
				if($user->is_verified == "0") {
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

	public function register(Request $request) {
		$rules = [
			'firstname' => "required",
			'lastname' => 'required',
			'email' => 'required|unique:users',
			'mobile_number' => 'required|min:10|unique:users',
			'state_id' => 'required|numeric',
			'city_id' => 'required|numeric',
			'password' => 'required|min:8',
			'confirm_password' => 'required|same:password|min:8'
			// 'owner_type' => 'required|numeric'
		];
		$this->checkValidate($request, $rules);

		try {
			if($request->owner_type == 1) {
				$request['role'] = 'owner';
			}else if($request->owner_type == 2) {
				$request['role'] = 'builder';
			}else if($request->owner_type == 3) {
				$request['role'] = 'agent';
			}
			$show_pass = $request->password;
			$request['name'] = "$request->firstname $request->lastname";
			$request['password'] = Hash::make($request->password);
			$request['auth_token'] = $this->_generateToken();
			$otp = rand(1000,4999);
			$request['otp'] = $otp;
			$picked = User::where('email', $request->email)->first();
			if($picked) {
				$this->_sendErrorResponse(400, 'Email Already Exist In Our Record.');
			}
			$user = User::create($request->all());
			if($user->exists()) {
				$sendOtp = $this->_sendOTP($user, null, $otp);
				$emailtemplate    = EmailTemplate::where('id',1)->first();
				$emailOTPtemplate = EmailTemplate::where('id',4)->first();
		        $ordertemplate = $emailtemplate->template;
		        $replacetemplate = Array(
		        	'#NAME'     => $user->firstname.' '.$user->lastname,
		            '#EMAIL'    => $user->email,
		            '#PASSWORD' => $show_pass,
		        );
		        foreach($replacetemplate as $agr_key => $agr_text) {
		            $ordertemplate = str_replace($agr_key, $agr_text, $ordertemplate);
		        }
		        $finaltemplate = $ordertemplate;
		        $otp_template = $emailOTPtemplate->template;
		        $replaceOTPtemplate = Array(
		        	'#NAME'    => $user->firstname.' '.$user->lastname,
		        	'#OTP'     => $otp
		        );
		        foreach($replaceOTPtemplate as $agr_key1 => $agr_text1) {
		            $otpTemplate = str_replace($agr_key1, $agr_text1, $otp_template);
		        }
        		$finalotptemplate = $otpTemplate;
				$user->notify(New WelcomeEmailNotification($finaltemplate, $emailtemplate->subject, $emailtemplate->image));
				$user->notify(New SendOtpEmailNotification($finalotptemplate, $emailOTPtemplate->subject, $emailOTPtemplate->image));
				if($sendOtp['success']) {
					$this->_sendResponse(['User' => $user], 'OTP Generated Successfully And Send On Your Registered Email & Mobile Number ');
				} else {
					$this->_sendErrorResponse(400, 'OTP could not be sent');
				}
			} else {
				$this->_sendErrorResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage()); 
		}

	}

	public function verifyOTP(Request $request) {
		$rules = [
			'otp' => 'required|numeric',
			'user_id' => 'required'
			// 'new_password' => 'required|min:8',
			// 'confirm_new_password' => 'required|same:new_password'
		];
		// $messages = ['otp.required' => "abc"];
		$this->checkValidate($request, $rules);
		try { 
			if($request->is_register) { // register form
				// $verify = Otp::where(['otp' => $request->otp, 'user_id' => $request->user_id])->first();
				$verify = User::find($request->user_id);
				if(isset($verify) && $verify->is_verified == "0") {
					$check_otp = Otp::where('otp', $request->otp)->first();
					if($check_otp) {
						$verify->is_verified = "1";
						if($verify->save()) {
							// Auth::attempt(['email' => $verify->email, 'password'=>$verify->password]);
							$check_otp->delete();
							$this->_sendResponse(['User' => $verify], 'OTP verified successfully');
						} else {
							$this->_sendErrorResponse(400, 'Account could not be verified');
						}
					} else {
						$this->_sendErrorResponse(400, 'OTP deosn\'t match');
					}
				} else if(isset($verify) && ( $verify->is_verified == "1" )) {
					$this->_sendErrorResponse(400, 'OTP is already verified');
				} else {
				}
			} else { // verify otp & set password
				// $verify = Otp::where(['otp' => $request->otp, 'user_id' => $request->user_id])->first();
				$verify = User::find($request->user_id);
				if(isset($verify) && $verify->otp == $request->otp) {
					$password = Hash::make($request->new_password);
					$verify->password = $password;
					// $verify->is_verified = "1";
					if($verify->save()) {
							$this->_sendResponse(['User' => $verify], 'Password updated successfully');
					} else {
						$this->_sendErrorResponse(400, 'Account could not be verified');
					}
				} else {
					$this->_sendErrorResponse(400, 'Invalid OTP');
				}
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}

	}

	public function forgotPassword(Request $request) {
		$rules = [
			'mobile_number' => 'required'
		];
		$this->checkValidate($request, $rules);

		try {
			$user = User::where('mobile_number', $request->mobile_number)->first();
			// if(!empty($user) && ($user->is_verified == "0")) {
			if(empty($user)) {
				$this->_sendErrorResponse(400, 'Mobile number not registered');
			// } else if ($user->is_verified == "0") {
			// 	$this->_sendErrorResponse(400, 'Please verify your account to continue.');
			} else {
				// return $user;
				// $sendOtp = $this->_sendOTP($user);
				$user->otp = rand(1000,4999);
				$user->save();
				$sendOtp = ['success' => 1];
				// return $sendOtp;
				if($sendOtp['success']) {
					$this->_sendResponse(['User' => $user], 'OTP Generated successfully');
				} else {
					$this->_sendResponse(400, 'Oops! OTP could not be sent.');
				}
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function resetPassword(Request $request) {
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
			if($user->save()) {
				$this->_sendResponse(['User' => $user],'Password updated successfully');
			} else {
				$this->_sendErrorResponse(400, 'An error occured.');
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, 'An error occured.');
		}

	}


	public function change_password(Request $request) {
		$rules = [
			'old_password' => 'required',
			'new_password' => 'required',
			'confirm_password' => 'required'
		];
		$this->checkValidate($request, $rules);

		try {
			$user_token = $request->get('users');

			$check_password = Hash::check($request->old_password,$user_token->password);
			if($check_password) {
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

	public function update_profile(Request $request) {
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
			if($user->update($request->all())) {
				$this->_sendResponse([], 'Profile updated successfully');
			} else {
				$this->_sendErrorResponse(400, 'An error occured');
			}			
		} catch(\Exception $e) {
			$this->_sendErrorResponse(500, 'An error occured');
		}

	}


}

