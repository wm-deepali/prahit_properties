<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\SubLocations;
use App\Locations;
use App\State;
use App\City;

class LocationsController extends AppController
{

	public function index(Request $request)
	{
		if ($request->input('city_id')) {
			$locations = Locations::with('Cities')->where('city_id', $request->input('city_id'))->withCount('SubLocations')->latest()->get();
		} else {
			$locations = Locations::with('Cities')->withCount('SubLocations')->latest()->get();
		}
		$states = State::where('country_id', 101)->get();
		return view('admin.locations.index', compact('locations', 'states'));
	}

	public function store(Request $request)
	{
		$rules = [
			'state_id' => 'required',
			'city_id' => 'required',
			'locations' => 'required|array',
			'locations.*' => 'required|string|distinct'
		];
		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$addedLocations = [];
			foreach ($request->locations as $locationName) {
				$locationName = trim($locationName);
				// Skip empty or duplicate locations for this city
				if (empty($locationName)) {
					continue;
				}
				$checkDuplicate = Locations::where('city_id', $request->city_id)
					->where('location', $locationName)
					->first();
				if ($checkDuplicate) {
					continue; // Skip duplicates
				}

				$location = Locations::create([
					'state_id' => $request->state_id,
					'city_id' => $request->city_id,
					'location' => $locationName,
				]);
				if ($location) {
					$addedLocations[] = $location;
				}
			}

			// Update city location count
			$city = City::find($request->city_id);
			if ($city) {
				$count = Locations::where('city_id', $city->id)->count();
				$city->update([
					'location' => $count
				]);
			}

			if (count($addedLocations) > 0) {
				$this->JsonResponse(200, 'Locations added successfully', ['Locations' => $addedLocations]);
			} else {
				$this->JsonResponse(400, 'No new locations were added.');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, 'An error occured');
		}
	}
	
	public function show($id)
	{
		$locations = Locations::findOrFail($id);
		$this->JsonResponse(200, 'Location found successfully', ['Location' => $locations]);
	}

	public function update(Request $request, $id)
	{
		$rules = [
			'state_id' => 'required',
			'city_id' => 'required',
			'location' => 'required',
			'status' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$location = Locations::find($request->id)->update($request->all());
			if ($location) {
				$picked = Locations::find($request->id);
				$city = City::find($picked->city_id);
				$count = Locations::where('city_id', $city->id)->count();
				$city->update(
					[
						'location' => $count
					]
				);
				$this->JsonResponse(200, 'Location updated successfully', ['Category' => $location]);
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, 'An error occured');
		}

	}

	public function edit_sublocation($id)
	{
		$location = Locations::with(['Cities', 'SubLocations'])->findOrFail(base64_decode($id));
		$states = State::where('country_id', 101)->get();
		$saved_state = State::find($location->state_id);
		$saved_city = City::find($location->city_id);
		$locations = Locations::where('state_id', $location->state_id)->where('city_id', $location->city_id)->get();
		return view('admin.locations.edit_sublocation', compact('location', 'states', 'saved_state', 'saved_city', 'locations'));
	}

	public function create_sublocation(Request $request)
	{
		$rules = [
			// 			'state_id' => 'required',
// 			'city_id' => 'required',
			'location_id' => 'required',
			'sub_location_name' => 'required|unique:sub_locations,sub_location_name'
		];
		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$checkDuplicate = SubLocations::where(['location_id' => $request->location_id, 'sub_location_name' => $request->sub_location])->count();
			if ($checkDuplicate > 0) {
				$this->JsonResponse(400, 'A sub location already exists in this location');
			}

			$sublocation = SubLocations::create($request->all());
			if ($sublocation) {
				$this->JsonResponse(200, 'Sublocation created successfully', ['Sublocation' => $sublocation]);
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function update_sublocation(Request $request)
	{
		$rules = [
			'sub_location_name' => 'required|unique:sub_locations,sub_location_name,' . $request->sub_location_id . ',id,location_id,' . $request->location_id
		];

		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$sublocation = SubLocations::find($request->sub_location_id)->update($request->all());
			if ($sublocation) {
				$this->JsonResponse(200, 'Sublocation updated successfully', ['Sublocation' => $sublocation]);
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function fetch_locations($city_id)
	{
		try {
			$cities = Locations::where('city_id', $city_id)->get();
			$this->JsonResponse(200, 'Locations found successfully', ['Locations' => $cities]);
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function fetch_sublocations($id)
	{
		try {
			$sublocation = SubLocations::where('location_id', $id)->get();
			$this->JsonResponse(200, 'Sublocation found successfully', ['SubLocation' => $sublocation]);
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function destroy($id)
	{
		try {
			$picked = Locations::find($id);
			$city = City::find($picked->city_id);
			$picked->delete();
			$count = Locations::where('city_id', $city->id)->count();
			$city->update(
				[
					'location' => $count
				]
			);
			$this->JsonResponse(200, 'Location deleted successfully');
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function delete_sublocation($id)
	{
		try {
			$delete = SubLocations::find($id)->delete();
			if ($delete) {
				$this->JsonResponse(200, 'Sub Location deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function fetch_cities_states($id)
	{
		$cities_data = City::where('state_id', $id)->get();
		return $cities_data;
	}

	public function manageSubLocations()
	{
		$locations = Locations::with('Cities')->withCount('SubLocations')->latest()->get();
		$states = Cities::all()->unique('city_state');
		$cities = Cities::all();
		return view('admin.locations.manage_sub_location', compact('locations', 'states', 'cities'));
	}
}

