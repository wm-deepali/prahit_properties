<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkValidate($request, $validFields, $messages = []) {
        $validator = Validator::make($request->all(), $validFields, $messages);
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $key => $messages) {
                return $validator->getMessageBag()->first($key);
            }
        }
	}
    

	public function jsonResponse($status, $message, $model = null) {
		echo json_encode(['status' => $status, 'message' => $message, 'data' => $model]);
		exit;
	}
}
