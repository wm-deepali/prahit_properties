<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\GlobalNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	use GlobalTrait;

    public function updateUserProfileCommon(Request $request) {
		$request->validate(
			[
				'firstname'     => 'required',
				'lastname'      => 'required',
				'email'         => 'required|unique:users,email,'.$request->user_id,
				'mobile_number' => 'required|unique:users,mobile_number,'.$request->user_id,
				'address'       => 'required|max:200',
				'gender'        => 'required',
				'state_id'      => 'nullable|integer',
				'city_id'       => 'nullable|integer',
			]
		);
	
		try {	
			$picked = User::find($request->user_id);
			$picked->update(
				[
					'firstname'     => $request->firstname,
					'lastname'      => $request->lastname,
					'email'         => $request->email,
					'mobile_number' => $request->mobile_number,
					'address'       => $request->address,
					'gender'        => $request->gender,
					'state_id'      => $request->state_id,
					'city_id'       => $request->city_id,
				]
			);
			return redirect()->back()->with('alert-success', 'User Profile Updated successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
		}
	}

	public function updateUserPasswordCommon(Request $request) {
		$request->validate(
			[
				'password' => 'required|same:new_password',
				'new_password' => 'required'
			]
		);
		try {	
			$picked = User::find($request->user_id);
			$picked->update(
				[
					'password' => \Hash::make($request->password)
				]
			);
			$sms = "Dear ".$picked->firstname." ".$picked->lastname." %0aYour Account Password Is Successfully Changed By Admin, Your New Password Are Given Below.%0a* Password: ".$request->password;
			$sendOtp = $this->sendSMSInformtaion($picked->mobile_number, $sms);
			$subject  = "Password Updation Information";
			$msg1 = "Your Account Password Is Successfully Changed By Admin, Your New Password Are Given Below.";
			$msg2 = "* Password: ".$request->password;
			$picked->notify(New GlobalNotification($picked, $subject, $msg1, $msg2));
			return redirect()->back()->with('alert-success', 'User Password Updated successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
		}
	}

	public function changeStatusCommon(Request $request) {
		try {	
			$picked = User::find($request->id);
			$status = $picked->status == 'Yes' ? 'No' : 'Yes';
			$picked->update(
				[
					'status' => $status
				]
			);
			$this->JsonResponse(200, 'User Status Changed successfully');
		} catch (\Exception $e) {
			$this->JsonResponse(500,$e->getMessage());
		}
	}

	public function deleteUserCommon(Request $request) {
		try {	
			$picked = User::find($request->id);
			$picked->delete();
			$this->JsonResponse(200, 'User Deleted successfully');
		} catch (\Exception $e) {
			$this->JsonResponse(500,$e->getMessage());
		}
	}
}
