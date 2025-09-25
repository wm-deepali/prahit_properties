<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\GlobalNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AgentController extends Controller
{
    use GlobalTrait;

    public function index() {
		$agenst = User::where('role', 'agent')->orderBy('id', 'DESC')->get();
		return view('admin.agent.index', compact('agenst'));
	}

	public function create(Request $request) {
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
					'firstname'     => $request->firstname,
					'lastname'      => $request->lastname,
					'email'         => $request->email,
					'mobile_number' => $request->mobile_number,
					'role'          => 'agent',
					'gender'        => $request->gender,
					'password'      => \Hash::make($request->password) 
				]
			);
			$sms = "Dear ".$user->firstname." ".$user->lastname." %0aYour Account Successfully Created, Login Credentials Are Given Below.%0a Login with ( Email/Mobile Number): ".$user->email."/".$user->mobile_number."%0aPassword: ".$request->password;
			$sendOtp = $this->sendSMSInformtaion($user->mobile_number, $sms);
			$subject  = "Registration Completed";
			$msg1 = "Your Account Successfully Created, Login Credentials Are Given Below.";
			$msg2 = "* Email/Mobile Number: ".$user->email."/".$user->mobile_number;
			$msg3 = "* Password: ".$request->password;
			$user->notify(New GlobalNotification($user, $subject, $msg1, $msg2, $msg3));
			return redirect()->back()->with('alert-success', 'Builder User created successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
		}
	}

	public function updateview($id) {
		$user = User::find($id);
		return view('admin.update_user_profile', compact('user'));
	}	
}
