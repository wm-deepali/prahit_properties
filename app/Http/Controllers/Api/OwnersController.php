<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use App\Owners;

class OwnersController extends BaseApiController {

	public function store(Request $request) {
		$rules = [
			'name' => 'required',
			'email' => 'required',
			'mobile_number' => 'required',
			'type' => 'required',
			'location' => 'required'
		];	
		$this->checkValidate($request, $rules);

		try {
			$owner = Owners::create($request->all());
			$this->_sendResponse(['Owner' => $owner], 'Owner created successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

}

