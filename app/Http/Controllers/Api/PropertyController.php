<?php

namespace App\Http\Controllers\Api;

use App\Locations;
use App\SubLocations;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use App\Http\Controllers\Concern\GlobalTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\PropertiesFields;
use App\PropertyGallery;
use App\AgentEnquiry;
use App\ClaimListing;
use App\Properties;
use App\Feedback;
use App\Visitor;
use App\Otp;
use App\User;

class PropertyController extends BaseApiController
{
	use GlobalTrait;

	public function __construct()
	{
		$this->middleware('api.auth', ['only' => 'my_properties', 'store']);
	}

	public function index(Request $request)
	{
		try {
			$user = $request->get('users');
			// GET Parameters
			$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';
			$category_id = isset($_GET['category']) ? $_GET['category'] : '';
			$location_id = isset($_GET['location']) ? $_GET['location'] : '';
			$title = isset($_GET['property']) ? $_GET['property'] : '';
			$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
			$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';
			$property_type = isset($_GET['type']) ? $_GET['type'] : '';
			$category = isset($_GET['category']) ? $_GET['category'] : '';

			$property = Properties::with([
				'PropertyTypes',
				'PropertyGallery',
				'Category',
				'Category.SubCategory',
				'Location'
			]);

			if (!empty($category_id)) {
				$category_id = explode(',', $category_id);
				foreach ($category_id as $key => $value) {
					$property = $property->orWhere('category_id', $value);
				}
			}
			if (!empty($location_id)) {
				$property = $property->whereIn('location_id', [$location_id]);
			}
			if (!empty($title)) {
				$property = $property->where('title', "LIKE", "%$title%");
			}
			if (!empty($min_price) && !empty($max_price)) {
				$property = $property->where('price', '>', $min_price);
			}
			if (!empty($property_type)) {
				$property = $property->where('type_id', $property_type);
			}
			if ($category) {
				$property = $property->where('category_id', decrypt($category));
			}

			if ($sort_by == 1) {
				$property = $property->orderBy('id', 'asc');
			} elseif ($sort_by == "2") {
				$property = $property->orderBy('id', 'desc');
			} elseif ($sort_by == "3") {
				$property = $property->orderBy('price', 'asc');
			} elseif ($sort_by == "4") {
				$property = $property->orderBy('price', 'desc');
			}

			$property = $property->where('approval', 'Approved')->get();
			$this->_sendResponse(['Property' => $property], 'Properties found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function my_properties(Request $request)
	{
		try {

			$user = $request->get('users');

			$property = Properties::with([
				'PropertyTypes',
				'PropertyGallery',
				'Category',
				'Category.SubCategory'
				// 'PropertyFeatures' => function($q) {
				// 	$q->skip(0)->take(3);
				// },
				// 'PropertyFeatures.SubFeatures'
			])->where('user_id', $user->id)->latest()->get();
			// return $properties;

			$this->_sendResponse(['Property' => $property], 'Properties found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}





	public function show($slug)
	{
		try {
			$property = Properties::with([
				'Location',
				'PropertyGallery',
				'PropertyFeatures',
				'PropertyFeatures',
				'PropertyFeatures.SubFeatures',
				'PropertyTypes',
				'getState',
				'getCity'
			])->where('slug', $slug)->first();
			$this->_sendResponse(['Property' => $property], 'Property found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function show_by_category($category_id)
	{
		try {
			$property = Properties::has('Category')->has('Location')->has('Location.SubLocations')->has('PropertyTypes')->with('Category', 'Location', 'PropertyTypes', 'Location.SubLocations')->where('category_id', $category_id)->get();
			$this->_sendResponse(['Properties' => $property], 'Properties found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function agent_enquiry(Request $request)
	{
		$rules = [
			"property_id" => "required",
			"name" => "required",
			"email" => "required|email",
			"mobile_number" => "required|numeric",
			"interested_in" => "required"
		];
		$this->checkValidate($request, $rules);

		try {
			$claim = AgentEnquiry::create($request->all());
			if ($claim->exists()) {
				$this->_sendResponse(['AgentEnquiry' => $claim]);
			} else {
				$this->_sendErrorResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function claim_listing(Request $request, $id)
	{
		$check_property = Properties::find($id);
		if (empty($check_property)) {
			$this->_sendErrorResponse(400, 'Listing not found!');
		}

		try {
			if ($request->email && !$request->otp) {
				$user = User::where('email', $request->email)->first();
				if (isset($user)) {
					$user->otp = rand(1000, 4999);
					$user->save();
					$this->_sendResponse([], 'Email sent successfully');
				} else {
					$this->_sendErrorResponse(400, 'No account exists with this email id.');
				}

			} elseif ($request->mobile_number && !$request->otp) {
				$user = User::where('mobile_number', $request->mobile_number)->first();
				if (isset($user)) {
					$user->otp = rand(1000, 4999);
					$user->save();
					$sendOtp = ['success' => 1];
					if ($sendOtp['success']) {
						$this->_sendResponse([], 'OTP sent successfully');
					} else {
						$this->_sendErrorResponse(400, 'OTP could not be sent');
					}
				} else {
					$this->_sendErrorResponse(400, 'No account exists with this mobile number');
				}

			}

			if ($request->otp) {
				$user = User::where('mobile_number', $request->mobile_number)->orWhere('email', $request->email)->first();
				if ($user->otp == $request->otp) {
					$request['property_id'] = $id;
					$request['user_id'] = $user->id;
					$claim_listing = ClaimListing::create($request->all());
					if ($claim_listing->exists()) {
						$user->otp = rand(1000, 4999);
						$user->save();

						$property = Properties::find($id);
						$property->user_id = $user->id;
						$property->save();
						$this->_sendResponse([], 'Listing claimed successfully');
					} else {
						$this->_sendErrorResponse(400, 'Listing could not be claimed');
					}
				} else {
					$this->_sendErrorResponse(400, 'Incorrect OTP');
				}
			}

			if (!$request->email || !$request->mobile_number) {
				$this->_sendErrorResponse(400, 'Please provide email or mobile number to continue');
			}


		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function feedback(Request $request)
	{

		// echo json_encode($request->all());
		// exit;

		$rules = [
			"property_id" => "required",
			"is_detail_correct" => "required",
			// "email" => "required",
			// "mobile_number" => "required",
			"feedback" => "required"
		];
		$this->checkValidate($request, $rules);

		try {

			if ($request->is_detail_correct == 1) {
				$request['is_feedback'] = "1";
				$request['is_complaint'] = "0";
				$request['is_agent_not_reachable'] = "0";
			} else if ($request->is_detail_correct == 2) {
				// $request['is_detail_correct'] = "0";
				$request['is_feedback'] = "0";
				$request['is_complaint'] = "1";
				$request['is_agent_not_reachable'] = "0";

				$request['complaint_type'] = implode(',', $request->complaint);

			} else {
				$request['is_feedback'] = "0";
				$request['is_complaint'] = "0";
				$request['is_agent_not_reachable'] = "1";

				$request['agent_not_reachable_type'] = implode(',', $request->agent_not_reachable_type);
			}


			$feedback = Feedback::create($request->all());
			if ($feedback->exists()) {
				$this->_sendResponse(['Feedback' => $feedback]);
			} else {
				$this->_sendErrorResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function create_visitor_otp(Request $request)
	{
		$rules = [
			// "email" => "required",
			"mobile_number" => "required|numeric"
		];
		$this->checkValidate($request, $rules);
		// try {
		$otp = rand(1000, 4000);
		$message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
		$response = $this->sendOtp($request->mobile_number, $message);
		if (!$response) {
			return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
		}
		Otp::create(
			[
				'otp' => $otp
			]
		);
		return response()->json([
			'success' => true,
			'message' => "OTP sent successfully!"
		]);
		// $this->_sendResponse([], 'OTP sent successfully');
		// } catch (\Exception $e) {
		// 	$this->_sendErrorResponse(500, $e->getMessage());
		// }
	}

	public function search_property()
	{
		try {
			$query = $_GET['query'];
			$property = Properties::with('PropertyGallery')->where('title', 'LIKE', "%$query%")->get();
			if (count($property) > 0) {
				$this->_sendResponse(['Property' => $property], count($property) . " Properties found");
			} else {
				$this->_sendResponse(['Property' => []], 'No Property found');
			}
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500);
		}

	}

}

