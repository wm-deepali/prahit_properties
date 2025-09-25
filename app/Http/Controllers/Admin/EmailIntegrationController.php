<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EmailIntegration;
use Auth;

class EmailIntegrationController extends Controller {

	public function index() {
		$email_settings = EmailIntegration::first();
		return view('admin.email_integration.index', compact('email_settings'));
	}

	public function update(Request $request, $id) { 
		try {
			$request->validate(
				[
					'driver'       => 'required|max:191',
					'host'         => 'required|max:191',
					'port'         => 'required|max:191',
					'username'     => 'required|max:191',
					'password'     => 'required|max:191',
					'encryption'   => 'required|max:191',
					'from_address' => 'required|max:191',
					'from_name'    => 'required|max:191',
				]
			);
			$email_integration = EmailIntegration::find($id);
			$email_integration->update(
				[
					'driver'      => $request->driver,
					'host'        => $request->host,
					'port'        => $request->port,
					'user_name'   => $request->username,
					'password'    => $request->password,
					'encryption'  => $request->encryption,
					'form_address'=> $request->from_address,
					'form_name'   => $request->from_name
				]
			);
			return redirect()->back()->with('success', 'Settings Updated Successfully.');
		} catch(\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}

	}

}
