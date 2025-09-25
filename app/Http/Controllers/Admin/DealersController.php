<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Dealers;
use App\User;

class DealersController extends Controller
{
	public function index() {
		$dealers = Dealers::with('User')->latest()->get();
		return view('admin.dealers.index', compact('dealers'));
	}

	public function store(Request $request) {
		$rules = [
			'name' => 'required',
			'email' => 'required',
			'mobile_number' => 'required',
			'type' => 'required',
			'gender' => 'required',
			'password' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {	
			$request['password'] = Hash::make($request->password);
			$user = User::create($request->all());
			if($user->exists) {
				$request['user_id'] = $user->id;
				$dealer = Dealers::create($request->all());
				if($dealer->exists) {
					$this->JsonResponse(200, 'Dealer created successfully', ['Dealer' => $dealer]);
				}
			} else {
				$this->JsonResponse(400, 'An error occured.');
			}
		} catch (\Exception $e) {
			if(isset($e->errorInfo)) {
				$this->JsonResponse(400, 'An account with this email id already exists.');
			} else {
				$this->JsonResponse(500, 'An error occured');
			}
		}
	}
}
