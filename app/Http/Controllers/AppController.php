<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Otp;
use App\Visitor;

class AppController {

    public function checkValidate($request, $validFields, $messages = []) {
        $validator = Validator::make($request->all(), $validFields, $messages);
        if ($validator->fails()) {
            foreach ($validator->getMessageBag()->toArray() as $key => $messages) {
                return $validator->getMessageBag()->first($key);
            }
        }
	}

	public function JsonResponse($status, $message, $data = []) {
		echo json_encode([
			'status' => $status,
			'message' => $message,
			'data' => $data
		]);
		exit;
	}
	
	public function fileUpload($request, $files) {
		$filesList = [];
		foreach ($files as $key => $value) {
			if($request->file($value)) {
				$file = $request->file($value);
				$fileName = $key.time().'_'.$file->getClientOriginalName();
				$file->move($key, $fileName);
				array_push($filesList, $fileName);
			}
		}
		return $filesList;
	}

	public function multipleFileUpload($request, $files) {
		$filesList = [];
		foreach ($files as $path => $value) {
	        if($request->hasfile($value)) {
	            foreach($request->file($value) as $file) {
	                // $name= $file.time().'_'.$file->getClientOriginalName();
					$fileName = $path.time().'_'.$file->getClientOriginalName();
	                $file->move(public_path().'/uploads/properties/gallery_images/', $fileName);  
	                // $data[] = $name;  
	                // echo " $path $file $fileName <br/>";
	                array_push($filesList, $fileName);
	            }
	        }
	    }
	    return $filesList;
	}


	public function forgot_password(Request $request) {

		try {
	        $credentials = ['email' => $request->email];
	        $response = Password::sendResetLink($credentials, function (Message $message) {
	            $message->subject($this->getEmailSubject());
	        });

	        switch ($response) {
	            case Password::RESET_LINK_SENT:
	            	return [ 'status' => 200, 'message' => "Forgot password email sent successfully."];
	            case Password::INVALID_USER:
	            	return [ 'status' => 400, 'message' => "User does not exist."];
	        }
		} catch (\Exception $e) {
			return [ 'status' => 500, 'message' => "An error occured"];
		}

	}


    public function _sendOTP($user,$is_visitor = null) {
        try {
            // $sendotp = Curl::to('http://sms.webmingo.in/api/otp.php?authkey=326070AyKV9eSm5e9545e4P1&mobile=919727782876&message=Your%20OTP%20is%200808&sender=BHOOMI&otp=0808')->post();

            $random = rand(0000,9999);

            if(is_null($is_visitor)) {
	            $otp = Otp::create(['otp' => $random, 'user_id' => $user->id]);
            } else {
	            $otp = Otp::create(['otp' => $random, 'visitor_id' => $user->id]);
            }

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,"http://sms.webmingo.in/api/sendhttp.php?authkey=326070AyKV9eSm5e9545e4P1&mobiles=$user->mobile_number&message=Your OTP is $random&sender=BHOOMI&route=4&country=91");
            curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS,
            //             "postvar1=value1&postvar2=value2&postvar3=value3");

            // In real life you should use something like:
            // curl_setopt($ch, CURLOPT_POSTFIELDS, 
            //          http_build_query(array('postvar1' => 'value1')));

            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close ($ch);

            if(isset($server_output)) {
                return ['success' => true];
            }
            // Further processing ...
            // if ($server_output == "OK") { ... } else { ... }

            return $sendotp;
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
            // echo $e->getMessage();exit;
        }
    }

}

