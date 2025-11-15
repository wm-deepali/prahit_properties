<?php

namespace App\Http\Controllers\Admin;

use App\Properties;
use Illuminate\Http\Request;
use App\Http\Controllers\AppController;
use App\Feedback;
use App\Category;
use App\ComplaintTypes;
use App\Locations;
use DataTables;
use Illuminate\Support\Facades\Session;
class FeedbackController extends AppController
{

	public function index(Request $request)
	{
		$category = Category::latest()->get();
		$location = Locations::all();
		if ($request->ajax()) {
			// $complaint_types = ComplaintTypes::all();
			$feedback = Feedback::has('Property')->with('Property')->where(['is_complaint' => "1"])->latest()->get();

			foreach ($feedback as $key => $value) {
				// $value->verified = "Yes";
				$explode = explode(',', $value->complaint_type);

				$value->complaint;
				foreach ($explode as $key1 => $value1) {
					$complaint_type = ComplaintTypes::find($value1, ['complaint_type']);
					if (isset($value->complaint)) {
						$value->complaint .= ", ";
					}
					$value->complaint .= $complaint_type->complaint_type;
				}

				if (isset($value->Property)) {
					$value->property_id = $value->Property->id;
					$value->property_title = $value->Property->title;
				}
			}
			return \Yajra\DataTables\DataTables::of($feedback)
				->addColumn('property_title', function ($feedback) {
					$picked = Properties::find($feedback->property_id);
					if ($picked) {
						$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $picked->id . ')" name="View Property">' . $picked->listing_id . '</a>';
						return $listing_id;

					} else {
						return 'N/A';
					}
				})
				->addColumn('feedback', function ($feedback) {
					return $feedback->feedback;
				})
				->addColumn('user_details', function ($feedback) {
					$mobile = $feedback->mobile_number ?? 'N/A';
					$email = $feedback->email ?? 'N/A';
					return "Mobile: $mobile <br> Email: $email";
				})
				->addColumn('action', function ($feedback) {
					if ($feedback->status == 'Inactive') {
						return '<a class="edit btn btn-primary btn-sm" onclick="changeStatus(' . $feedback->id . ')">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </a>';
					} else {
						return '<a class="edit btn btn-primary btn-sm" onclick="changeStatus(' . $feedback->id . ')">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>';
					}
				})
				->rawColumns(['property_title', 'feedback', 'action', 'user_details'])
				->make(true);
		}
		return view('admin.feedback.index', compact('category', 'location'));

	}

	public function propertyFeedbacks(Request $request)
	{
		$category = Category::latest()->get();
		$location = Locations::all();

		if ($request->ajax()) {
			$feedback = Feedback::has('Property')
				->with('Property')
				->where('is_feedback', "1")
				->latest()
				->get();

			foreach ($feedback as $key => $value) {
				if (isset($value->Property)) {
					$value->property_id = $value->Property->id;
					$value->property_title = $value->Property->title;
				}
			}

			return \Yajra\DataTables\DataTables::of($feedback)
				->addColumn('property_title', function ($feedback) {
					$picked = Properties::find($feedback->property_id);
					if ($picked) {
						$listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $picked->id . ')" name="View Property">' . $picked->listing_id . '</a>';
						return $listing_id;

					} else {
						return 'N/A';
					}
				})
				->addColumn('feedback', function ($feedback) {
					return $feedback->feedback;
				})
				->addColumn('user_details', function ($feedback) {
					$mobile = $feedback->mobile_number ?? 'N/A';
					$email = $feedback->email ?? 'N/A';
					return "Mobile: $mobile <br> Email: $email";
				})
				->addColumn('action', function ($feedback) {
					if ($feedback->status == 'Inactive') {
						return '<a class="edit btn btn-primary btn-sm" onclick="changeStatus(' . $feedback->id . ')">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </a>';
					} else {
						return '<a class="edit btn btn-primary btn-sm" onclick="changeStatus(' . $feedback->id . ')">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>';
					}
				})
				->rawColumns(['property_title', 'feedback', 'user_details', 'action'])
				->make(true);
		}

		return view('admin.feedback.feedback', compact('category', 'location'));
	}


	public function show($id)
	{
		$feedback = Feedback::findOrFail($id);
		$this->JsonResponse(200, 'Feedback found succesfully', ['Feedback' => $feedback]);
	}

	public function changeStatusPropertyFeedbacks(Request $request)
	{
		try {
			$picked = Feedback::find($request->id);
			$status = $picked->status == 'Active' ? 'Inactive' : 'Active';
			$picked->update(
				[
					'status' => $status
				]
			);
			$this->JsonResponse(200, 'Feedback Status Changed successfully');
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function apply_filters(Request $request)
	{
		try {

			$get_values = $_GET;

			$filters = [];
			foreach ($get_values as $key => $value) {
				if (strpos($key, "filter_") !== false) {
					$new_key = str_replace('filter_', '', $key);
					if (strpos($new_key, 'properties') !== false) {
						$new_key = str_replace('properties_', 'properties.', $new_key);
					} else if (strpos($new_key, 'category_') !== false) {
						$new_key = str_replace('category_', 'category.', $new_key);
					}
					$filters[$new_key] = $value;
				}
			}

			// $properties = Properties::with('Category','Category.Subcategory','Location')->latest()->where($filters)->get();

			$feedback = Feedback::with('Property', 'Property.Category')->where(['properties.category_id' => '1', 'is_complaint' => "1"])->get();

			if ($request->ajax()) {
				foreach ($feedback as $key => $value) {
					// $value->verified = "Yes";
					$explode = explode(',', $value->complaint_type);

					$value->complaint;
					foreach ($explode as $key1 => $value1) {
						if (isset($value1)) {
							$complaint_type = ComplaintTypes::find($value1, ['complaint_type']);
							if (isset($value->complaint)) {
								$value->complaint .= ", ";
							}
							$value->complaint .= $complaint_type->complaint_type;
						}
					}

					if (isset($value->Property)) {
						$value->property_id = $value->Property->id;
						$value->property_title = $value->Property->title;
					}
				}

				return DataTables::of($feedback)
					->addColumn('property_title', function ($feedback) {
						$property_title = '<a href="#" onclick="fetchPropertyDetails(' . $feedback->property_id . ')" name="edit">' . $feedback->property_title . '</a>';
						return $property_title;
					})
					->addColumn('feedback', function ($feedback) {
						$feedback = '<a href="#" onclick="fetchFeedback(' . $feedback->id . ')">View Experience</a>';
						return $feedback;
					})
					// ->addColumn('action', function($feedback){
					//     $button = '<a name="edit" class="edit btn btn-primary btn-sm" href="properties/'.base64_encode($feedback->id).'/edit">Delete</a>';
					//     return $button;
					// })
					->rawColumns(['property_title', 'feedback', 'action'])
					->make(true);
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	// Create Feedback (after OTP verified)
	public function createFeedback(Request $request)
	{
		$request->validate([
			"feedback" => "required",
			"mobile_number" => "required|digits:10",
		]);

		try {
			if ($request->is_detail_correct == 1) {
				$request['is_feedback'] = "1";
				$request['is_complaint'] = "0";
				$request['is_agent_not_reachable'] = "0";
			} else if ($request->is_detail_correct == 2) {
				$request['is_feedback'] = "0";
				$request['is_complaint'] = "1";
				$request['is_agent_not_reachable'] = "0";
				$request['complaint_type'] = implode(',', $request->complaint ?? []);
			} else {
				$request['is_feedback'] = "0";
				$request['is_complaint'] = "0";
				$request['is_agent_not_reachable'] = "1";
				$request['agent_not_reachable_type'] = implode(',', $request->agent_not_reachable_type ?? []);
			}

			$feedback = Feedback::create($request->all());

			return response()->json([
				'success' => true,
				'message' => 'Your feedback has been successfully sent!'
			]);

		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
		}
	}

	// Send OTP
	public function sendOtp(Request $request)
	{
		$request->validate([
			'mobile_number' => 'required|digits:10', // assuming 10-digit mobile
		]);

		$mobile = $request->mobile_number;

		// Generate 4-digit OTP
		$otp = rand(1000, 9999);

		// Store OTP in session with mobile as key
		Session::put('feedback_otp_' . $mobile, $otp);
		Session::put('feedback_otp_time_' . $mobile, now());

		// Simulate sending SMS (replace with actual SMS API)
		$message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
		$response = \App\Helpers\Helper::sendOtp($request->mobile_number, $message);
		if (!$response) {
			return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
		}

		return response()->json([
			'success' => true,
			'message' => 'OTP sent successfully.'
		]);
	}

	// Verify OTP
	public function verifyOtp(Request $request)
	{
		$request->validate([
			'mobile_number' => 'required|digits:10',
			'otp' => 'required|digits:4',
		]);

		$mobile = $request->mobile_number;
		$otp = $request->otp;

		$savedOtp = Session::get('feedback_otp_' . $mobile);
		$otpTime = Session::get('feedback_otp_time_' . $mobile);

		if (!$savedOtp || !$otpTime) {
			return response()->json(['success' => false, 'message' => 'OTP expired or not sent.']);
		}

		// Optional: check OTP expiry (5 minutes)
		if (now()->diffInMinutes($otpTime) > 5) {
			Session::forget('feedback_otp_' . $mobile);
			Session::forget('feedback_otp_time_' . $mobile);
			return response()->json(['success' => false, 'message' => 'OTP expired.']);
		}

		if ($savedOtp == $otp) {
			// OTP verified, remove from session
			Session::forget('feedback_otp_' . $mobile);
			Session::forget('feedback_otp_time_' . $mobile);

			return response()->json(['success' => true, 'message' => 'OTP verified successfully.']);
		}

		return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
	}


}


