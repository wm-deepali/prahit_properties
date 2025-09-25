<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentGateway;
use Auth;

class PaymentGatewayController extends Controller {

	public function index() {
		$payment_gateway = PaymentGateway::first();
		return view('admin.payment_gateway.index', compact('payment_gateway'));
	}

	public function update(Request $request, $id) {
		$rules = [
			'auth_header' => 'required',
			'merchant_key' => 'required',
			'merchant_salt' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$payment_gateway = PaymentGateway::find($id);
			if($payment_gateway->update($request->all())) {
				$this->JsonResponse(200, 'Payment Gateway updated successfully',null);
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch(\Exception $e) {
			$this->JsonResponse(500, 'An error occured');
		}

	}

}
