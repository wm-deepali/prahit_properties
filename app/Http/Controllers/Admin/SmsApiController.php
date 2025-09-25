<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\AppController;
use App\SmsConfig;
use Illuminate\Support\Facades\Auth;

class SmsApiController extends AppController {

	public function edit_config() {  
		$smsconfig = SmsConfig::first(); 
		return view('admin.sms_config.edit', compact('smsconfig'));
	}

	public function update_config(Request $request) {
		$request->validate(
			[
				'sender_id'    => 'required|max:50',
				'hash_key'     => 'required|max:100',
				'route'        => 'required|integer',
				'country_code' => 'required|integer',
			]
		);
		$picked = SmsConfig::find($request->id);
		$picked->update(
			[
				'sender_id'    => $request->sender_id, 
				'hash_key'     => $request->hash_key, 
				'route'        => $request->route, 
				'country_code' => $request->country_code
			]
		);
		return redirect()->back()->with('success', 'Settings Updated Successfully.');
	}

}
