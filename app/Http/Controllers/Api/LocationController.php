<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use App\Locations;
use App\SubLocations;
use App\Cities;
use App\City;

class LocationController extends BaseApiController {

	public function index() {
		try {
			$locations = Locations::all();
			$this->_sendResponse(['Locations' => $locations], 'Locations found successfully');
		} catch(\Exception $e) {
			$this->_sendErrorResponse(500, 'An error occured');
		}
	}

	public function state() {
		try {
			$state = Cities::all()->unique('city_state')->flatten();
			$this->_sendResponse(['States' => $state], 'States found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function city($id) {
		try {
			$state_id = Cities::findOrFail($id);
			$state = Cities::where('city_state', $state_id->city_state)->get();
			$this->_sendResponse(['Cities' => $state], 'Cities found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500);
		}
	}

	public function show($id) {
		try {
			$location = Locations::findOrFail($id);
			$this->_sendResponse(['Location' => $location], 'Location found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500);
		}
	}

	public function show_sublocation($id) {
		try {
			$sub_location = SubLocations::findOrFail($id);
			$this->_sendResponse(['SubLocation' => $sub_location], 'SubLocation found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function fetch_sublocations($id) {
		try {
			$sublocation = SubLocations::where('location_id',$id)->get();
			$this->_sendResponse(['SubLocation' => $sublocation], 'SubLocation found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}
	
	public function fetch_sublocation($id) {
		try {
			$sublocation = SubLocations::where('id',$id)->first();
			$this->_sendResponse(['SubLocation' => $sublocation], 'SubLocation found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function fetch_cities_states($id) {
		try {
			$cities = City::where('state_id', $id)->get();
			$this->_sendResponse(['Cities' => $cities], 'City found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}



}

