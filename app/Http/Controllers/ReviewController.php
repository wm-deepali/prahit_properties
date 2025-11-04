<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Review;
use App\User;
use App\EmailTemplate;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WelcomeEmailNotification;
class ReviewController extends Controller
{
    public function sendOtp(Request $request)
    {
        $otp = rand(100000, 999999);
        Session::put('review_otp', $otp);
        Session::put('review_phone', $request->phone);

        // Simulate sending SMS (replace with actual SMS API)
        $message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
        $response = \App\Helpers\Helper::sendOtp($request->phone, $message);

        if (!$response) {
            return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
        }

        // 🔹 You can integrate actual SMS sending (like Twilio, MSG91, etc.)
        return response()->json(['success' => true, 'otp' => $otp]); // remove 'otp' in production
    }

    public function verifyOtp(Request $request)
    {
        if (
            $request->otp == Session::get('review_otp') &&
            $request->phone == Session::get('review_phone')
        ) {
            Session::put('review_verified', true);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }



    public function submitReview(Request $request)
    {
        // ✅ Step 1: Ensure OTP or user login is verified
        if (!auth()->check() && !Session::get('review_verified')) {
            return response()->json([
                'success' => false,
                'message' => 'OTP not verified. Please verify your phone number before submitting a review.',
            ]);
        }

        // ✅ Step 2: Validate input
        $validated = $request->validate([
            'profile_section_id' => 'required|exists:profile_sections,id',
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:20',
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        // try {
        // ✅ Step 3: If user is not logged in, create or log them in
        if (!auth()->check()) {
            $user = User::where('mobile_number', $validated['phone'])
                ->orWhere('email', $validated['email'] ?? null)
                ->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'role' => 'user',
                    'firstname' => $validated['name'],
                    'lastname' => '',
                    'email' => $validated['email'] ?? null,
                    'mobile_number' => $validated['phone'],
                    'password' => bcrypt('123456'), // default password
                    'status' => 1,
                    'mobile_verified' => 1,
                    'is_verified' => 1,
                ]);

                $emailtemplate = EmailTemplate::where('id', 1)->first();
                $ordertemplate = $emailtemplate->template;
                $replacetemplate = [
                    '#NAME' => $validated['name'],
                    '#EMAIL' => $validated['email'],
                    '#PASSWORD' => '123456',
                ];
                foreach ($replacetemplate as $key => $val) {
                    $ordertemplate = str_replace($key, $val, $ordertemplate);
                }
                $user->notify(new WelcomeEmailNotification($ordertemplate, $emailtemplate->subject, $emailtemplate->image));
            }

            // Log in the user
            Auth::login($user);
        }

        // ✅ Step 4: Create review
        $review = Review::create([
            'profile_section_id' => $validated['profile_section_id'],
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'rating' => $validated['rating'],
            'comment' => $validated['review'],
        ]);

        // ✅ Step 5: Clear OTP session
        Session::forget('review_verified');

        return response()->json([
            'success' => true,
            'message' => 'Review submitted successfully!',
            'review' => $review,
        ]);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Something went wrong. Please try again later.',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }
    }

}

