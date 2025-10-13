<?php
namespace App\Http\Controllers\Concern;

use App\Otp;
use App\SmsConfig;
use App\EmailIntegration;
use Illuminate\Support\Facades\Validator;
use App\Notifications\GlobalEmailNotification;
use Illuminate\Validation\ValidationException;
trait GlobalTrait
{
    /**
     *
     *
     *  Send OTP Global Function
     *
     */
    public function _sendOTP($user, $is_visitor = null, $otp_check = null)
    {
        try {
            // $sendotp = Curl::to('http://sms.webmingo.in/api/otp.php?authkey=326070AyKV9eSm5e9545e4P1&mobile=919727782876&message=Your%20OTP%20is%200808&sender=BHOOMI&otp=0808')->post();
            if ($otp_check == null) {
                $random = rand(0000, 9999);
            } else {
                $random = $otp_check;
            }
            if (is_null($is_visitor)) {
                $otp = Otp::create(['otp' => $random, 'user_id' => $user->id]);
            } else {
                $otp = Otp::create(['otp' => $random, 'visitor_id' => $user->id]);
            }

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "http://sms.webmingo.in/api/sendhttp.php?authkey=326070AyKV9eSm5e9545e4P1&mobiles=$user->mobile_number&message=Your OTP is $random&sender=BHOOMI&route=4&country=91");
            curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS,
            //             "postvar1=value1&postvar2=value2&postvar3=value3");

            // In real life you should use something like:
            // curl_setopt($ch, CURLOPT_POSTFIELDS, 
            //          http_build_query(array('postvar1' => 'value1')));

            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close($ch);

            if (isset($server_output)) {
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


    public function sendSMSInformtaion($mobile_number, $message)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://sms.webmingo.in/api/sendhttp.php?authkey=133780APe3PZcx5850ea44&mobiles=$mobile_number&message=$message&sender=WMINGO&route=4&country=91");
            curl_setopt($ch, CURLOPT_POST, 1);
            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            if (isset($server_output)) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Something Happned Wrong, SMS Not Send'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
            // echo $e->getMessage();exit;
        }
    }

    public function sendOtp($mobile, $message)
    {
        // Fetch settings
        $authKey = env('SMS_AUTH_KEY', '133780APe3PZcx5850ea44');
        $sender = env('SMS_SENDER_ID', 'WMINGO');
        $peId = env('SMS_PE_ID', '1301160576431389865');

        $templateId = env('SMS_DLT_ID', '1307161465983326774');

        $request_parameter = [
            'authkey' => $authKey,
            'mobiles' => $mobile,
            'sender' => $sender,
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
        ];

        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach ($request_parameter as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }

        if ($templateId) {
            $url .= 'DLT_TE_ID=' . $templateId . '&';
        }
        if ($peId) {
            $url .= 'PE_ID=' . $peId . '&';
        }

        $url = rtrim($url, "&");

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output = curl_exec($ch);
            curl_close($ch);
            return true;
        } catch (\Exception $e) {
            // dd($e->getMessage());
            \Log::error('SMS sending failed: ' . $e->getMessage());
            return false;
        }
    }
    protected function checkValidDatatype($data)
    {
        if (is_numeric($data)) {
            return 'mobile_number';
        } else {
            return 'email';
        }
    }



    public function checkValidate($request, $validFields, $messages = [])
    {
        $validator = Validator::make($request->all(), $validFields, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function multipleFileUpload($request, $files)
    {
        $filesList = [];
        foreach ($files as $path => $value) {
            if ($request->hasfile($value)) {
                foreach ($request->file($value) as $file) {
                    $fileName = $path . rand(10000, 99999) . '_' . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/properties/gallery_images/', $fileName);
                    // $data[] = $name;  
                    // echo " $path $file $fileName <br/>";
                    array_push($filesList, $fileName);
                }
            }
        }
        return $filesList;
    }

    protected function imageUpload($data, $key, $old_file = null, $path)
    {
        if ($data->$key) {
            if ($old_file) {
                $file = basename($old_file);
                if (file_exists(public_path('payment_screenshots/') . $file)) {
                    unlink(public_path("payment_screenshots/") . $file);
                }
            }
            $filename = $data->$key->getClientOriginalName();
            $fileExtension = $data->$key->getClientOriginalExtension();
            $imageName = base64_encode(str_replace(' ', '', $filename)) . date('ymdhis') . '.' . $fileExtension;
            $return = $data->file($key)->move(
                base_path() . '/public/payment_screenshots/',
                $imageName
            );
            $image_path = asset('public/payment_screenshots/' . $imageName);
        } else {
            $image_path = $old_file;
        }
        return $image_path;
    }

    protected function imageDeleteFromFolder($folder_path, $image)
    {
        $file = basename($image);
        if (file_exists(public_path($folder_path) . $file)) {
            unlink(public_path($folder_path) . $file);
        } else {
            return true;
        }
    }


    /**
     * Send Global SMS Added On 20-05-2021
     *
     * @param  \Illuminate\Http\Request  $request
     * @return instance of App\User
     **/
    protected function sendGlobalSMS($mobile_number, $message)
    {
        $config = SmsConfig::first();
        $request_parameter = array(
            'authkey' => $config->hash_key,
            'mobiles' => $mobile_number,
            'message' => urlencode($message),
            'sender' => $config->sender_id,
            'route' => $config->route,
            'country' => $config->country_code,
        );
        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach ($request_parameter as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }
        $url = rtrim($url, "&");
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //get response
            $output = curl_exec($ch);
            curl_close($ch);
            return 'SMS Send Successfully.';
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    protected function checkValidLoginType($key)
    {
        $data = is_numeric($key) ? 'mobile' : 'email';
        return $data;
    }

    protected function modifyMessageTemplate($message, $variable)
    {
        $replaceMessage = $variable;
        foreach ($replaceMessage as $agr_key => $agr_text) {
            $message = str_replace($agr_key, $agr_text, $message);
        }
        $new_message = $message;
        return $new_message;
    }

    public function __sendEmail($user, $template, $subject, $image, $variable)
    {
        try {
            $_template = $this->modifyMessageTemplate($template, $variable);
            $user->notify(new GlobalEmailNotification($_template, $subject, $image));
            return true;
        } catch (\Exception $e) {
            dd('Email Not Sending, Because Of ' . $e->getMessage());
        }

    }

    public function __sendDBNotification($user, $type, $template, $for_user = null, $variable)
    {
        try {
            $_template = $this->modifyMessageTemplate($template, $variable);
            $user->notify(new DBGlobalNotification($type, $_template, $for_user));
        } catch (\Exception $e) {
            dd('DB Notification Not Created, Because Of ' . $e->getMessage());
        }
    }

    public function getEmailSettings()
    {
        $data = EmailIntegration::first();
        return $data;
    }
}