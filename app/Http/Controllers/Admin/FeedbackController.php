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

	public function manageAll()
	{
		$category = Category::latest()->get();
		$location = Locations::all();

		return view('admin.feedback.index', compact('category', 'location'));
	}

	public function ajaxComplaints(Request $request)
	{
		if ($request->ajax()) {

			$feedback = Feedback::has('Property')
				->with('Property')
				->where('is_complaint', "1")
				->latest()
				->get();

			foreach ($feedback as $value) {

				$explode = explode(',', $value->complaint_type);
				$value->complaint = "";

				foreach ($explode as $cid) {
					$ctype = ComplaintTypes::find($cid);
					if ($ctype) {
						$value->complaint .= ($value->complaint ? ', ' : '') . $ctype->complaint_type;
					}
				}

				if ($value->Property) {
					$value->property_id = $value->Property->id;
					$value->property_title = $value->Property->title;
				}
			}

			return DataTables::of($feedback)
				->addColumn('property_title', function ($f) {
					return '<a href="#" onclick="fetchPropertyDetails(' . $f->property_id . ')">' . $f->Property->listing_id . '</a>';
				})
				->addColumn('feedback', fn($f) => $f->feedback)
				->addColumn('user_details', function ($f) {
					return "Mobile: {$f->mobile_number}<br>Email: {$f->email}";
				})
				->addColumn('action', function ($f) {
					$statusIcon = $f->status == 'Inactive' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
					$statusBtn = '<a class="btn btn-primary btn-sm" onclick="changeStatus(' . $f->id . ')">' . $statusIcon . '</a>';
					$deleteBtn = '<a class="btn btn-danger btn-sm" onclick="deleteFeedback(' . $f->id . ')"><i class="fa fa-trash"></i></a>';

					return $statusBtn . ' ' . $deleteBtn;
				})
				->rawColumns(['property_title', 'feedback', 'user_details', 'action'])
				->make(true);
		}
	}

	public function ajaxFeedbacks(Request $request)
	{
		if ($request->ajax()) {

			$feedback = Feedback::has('Property')
				->with('Property')
				->where('is_feedback', "1")
				->latest()
				->get();

			foreach ($feedback as $value) {
				if ($value->Property) {
					$value->property_id = $value->Property->id;
					$value->property_title = $value->Property->title;
				}
			}

			return DataTables::of($feedback)
				->addColumn('property_title', function ($f) {
					return '<a href="#" onclick="fetchPropertyDetails(' . $f->property_id . ')">' . $f->Property->listing_id . '</a>';
				})
				->addColumn('feedback', fn($f) => $f->feedback)
				->addColumn('user_details', function ($f) {
					return "Mobile: {$f->mobile_number}<br>Email: {$f->email}";
				})
				->addColumn('action', function ($f) {
					$statusIcon = $f->status == 'Inactive' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
					$statusBtn = '<a class="btn btn-primary btn-sm" onclick="changeStatus(' . $f->id . ')">' . $statusIcon . '</a>';
					$deleteBtn = '<a class="btn btn-danger btn-sm" onclick="deleteFeedback(' . $f->id . ')"><i class="fa fa-trash"></i></a>';

					return $statusBtn . ' ' . $deleteBtn;
				})
				->rawColumns(['property_title', 'feedback', 'user_details', 'action'])
				->make(true);
		}
	}

	public function ajaxAgent(Request $request)
	{
		if ($request->ajax()) {

			$feedback = Feedback::has('Property')
				->with('Property')
				->where('is_agent_not_reachable', "1")
				->latest()
				->get();

			foreach ($feedback as $value) {

				$explode = explode(',', $value->agent_not_reachable_type);
				$value->agent_issue = "";

				foreach ($explode as $cid) {
					$ctype = ComplaintTypes::find($cid);
					if ($ctype) {
						$value->agent_issue .= ($value->agent_issue ? ', ' : '') . $ctype->complaint_type;
					}
				}

				if ($value->Property) {
					$value->property_id = $value->Property->id;
					$value->property_title = $value->Property->title;
				}
			}

			return DataTables::of($feedback)
				->addColumn('property_title', function ($f) {
					return '<a href="#" onclick="fetchPropertyDetails(' . $f->property_id . ')">' . $f->Property->listing_id . '</a>';
				})
				->addColumn('agent_issue', fn($f) => $f->agent_issue)
				->addColumn('user_details', function ($f) {
					return "Mobile: {$f->mobile_number}<br>Email: {$f->email}";
				})
				->addColumn('action', function ($f) {
					$statusIcon = $f->status == 'Inactive' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
					$statusBtn = '<a class="btn btn-primary btn-sm" onclick="changeStatus(' . $f->id . ')">' . $statusIcon . '</a>';
					$deleteBtn = '<a class="btn btn-danger btn-sm" onclick="deleteFeedback(' . $f->id . ')"><i class="fa fa-trash"></i></a>';

					return $statusBtn . ' ' . $deleteBtn;
				})
				->rawColumns(['property_title', 'agent_issue', 'user_details', 'action'])
				->make(true);
		}
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

	public function deleteFeedback(Request $request)
	{
		try {
			$feedback = Feedback::findOrFail($request->id);
			$feedback->delete();

			return response()->json([
				'status' => 200,
				'message' => 'Feedback deleted successfully.'
			]);

		} catch (\Exception $e) {
			return response()->json([
				'status' => 500,
				'message' => $e->getMessage()
			]);
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


