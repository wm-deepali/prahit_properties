<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Concern\GlobalTrait;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Properties;
use App\Category;
use App\Locations;
use App\FormTypes;
use App\Cities;
use App\State;
use App\User;
use App\Otp;
use Hash;
use Auth;

class UserController extends AppController {
	use GlobalTrait;

	/*************
	**
	** User's Login Function
	**
	**/
	public function login_ajax(Request $request) {
        if($request->ajax()) {
            if($request->otp) {
				$picked_otp = Otp::where('otp', $request->otp)->first();
				if($picked_otp) {
					$user       = User::find($picked_otp->user_id);
					if($user) {
						\Auth::login($user);
						$picked_otp->delete();
						return response()->json(['status' => 200,'message' => 'Login Successful', 'role' => \Auth::user()->role]);
					}else {
						return response()->json(['status' => 400, 'message' => 'User Not Found.']);
					}
				}else {
					return response()->json(['status' => 400, 'message' => 'Invalid OTP, Please Enter Correctly.']);
				}
			}
        	$type = $this->checkValidDatatype($request->email);
        	if($type == 'email') {
        		$auth = \Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        	}else {
        		$auth = \Auth::attempt(['mobile_number' => $request->email, 'password' => $request->password]);
        	}
            try {
                if($auth) {
                    return response()->json(['status' => 200,'message' => 'Login Successful', 'role' => \Auth::user()->role]);
                } else {
                    return response()->json(['status' => 400,'message' => 'Invalid Credentials']);
                }
            } catch (\Exception $e) {
                return response()->json(['status' => 500]);
            }
        }
    }

    /*************
	**
	** Owner Dashboard 
	**
	**/
	public function dashboard() {
		return view('front.user.dashboard');
	}

	/*************
	**
	** Builder Dashboard 
	**
	**/
	public function builderDashboard() {
		return view('front.builder.dashboard');
	}

	/*************
	**
	** Agent Dashboard 
	**
	**/
	public function agentDashboard() {
		return view('front.agent.dashboard');
	}

	public function all_properties() {
		$properties = Properties::with([
			'PropertyTypes',
			'PropertyGallery',
			'Category',
			'Category.SubCategory'
		])->where('user_id', \Auth::id())->orderBy('id', 'DESC')->get();
		return view('front.user.properties', compact('properties'));
	}

	public function builderAllProperties() {
		$properties = Properties::with([
			'PropertyTypes',
			'PropertyGallery',
			'Category',
			'Category.SubCategory'
		])->where('user_id', \Auth::id())->orderBy('id', 'DESC')->get();
		return view('front.builder.properties', compact('properties'));
	}

	public function agentAllProperties() {
		$properties = Properties::with([
			'PropertyTypes',
			'PropertyGallery',
			'Category',
			'Category.SubCategory'
		])->where('user_id', \Auth::id())->orderBy('id', 'DESC')->get();
		return view('front.agent.properties', compact('properties'));
	}

	public function see_profile() {
		$states = State::where('country_id', 101)->get();
		$user = User::with('StateCity')->find(Auth::user()->id);
		// return $user;
		return view('front.user.profile', compact('states','user'));
	}

	public function seeBuilderProfile() {
		$states = State::where('country_id', 101)->get();
		$user = User::with('StateCity')->find(Auth::user()->id);
		// return $user;
		return view('front.builder.profile', compact('states','user'));
	}

	public function seeAgentProfile() {
		$states = State::where('country_id', 101)->get();
		$user = User::with('StateCity')->find(Auth::user()->id);
		// return $user;
		return view('front.agent.profile', compact('states','user'));
	}

	public function update_profile(Request $request) {
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

	public function update_password(Request $request) {
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

	public function upload_avatar(Request $request) {
		$rules = [
			"avatar_file" => "required"
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			return response()->json(['status' => 400, 'message' => $isValid]);
		}

		try {
			$file = $this->fileUpload($request, ['uploads/avatar/' => 'avatar_file']);
			if(isset($file[0])) {
				$user = User::find($request->user_id);
				$user->avatar = $file[0];
				if($user->save()) {
					return response()->json(['status' => 200, 'avatar_file' => $file[0]]);
				} else {
					return response()->json(['status' => 400]);
				}
			}
		} catch (\Exception $e) {
			return response()->json(['status' => 500]);
		}

	}

	public function userlogout(Request $request) {
		\Auth::logout();
        \Session::flush();
		return redirect('/');
	}

}

