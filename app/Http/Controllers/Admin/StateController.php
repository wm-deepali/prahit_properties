<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables; 
use App\State;
use App\City;

class StateController extends Controller
{
    public function manageStates() {
    	return view('admin.state.index');
    }

    public function manageStateDatatable(Request $request) {
    	if ($request->ajax()) {
            $datas = State::where('country_id', 101)->orderBy('name', 'ASC')->get();
            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('cities_count', function($row){
                	return '<a href="'.route('admin.manageCities', $row->id).'">'.$row->total_cities.'</a>';
                })
                ->addColumn('action', function($row){
                	return '<ul class="action">
                				<li><a href="'.route('admin.manageCities', $row->id).'" title="Manage Cities"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                    			<li>
                    				<a href="#" title="Edit State" onclick="fetchData('.$row->id.')"><i class="fas fa-edit"></i></a>
								</li>
								<li>
									<a href="#" title="Delete State" onclick="deleteState('.$row->id.')"><i class="fa fa-trash" aria-hidden="true"></i></a>
								</li>
							</ul>';
                })
                ->rawColumns(['action', 'cities_count'])
                ->make(true);
        }
    }

    public function createState(Request $request) {
    	$request->validate(
    		[
    			'name'       => 'required|max:150'
    		]
    	);
    	State::create(
    		[
    			'country_id' => 101,
    			'name'       => $request->name
    		]
    	);
    	return redirect()->back()->with('success', 'State Added Successfully.');
    }

    public function stateInfo($id) {
    	try {
            $picked = State::find($id);
            if($picked) {
                $this->JsonResponse(200, 'Data found successfully', ['picked' => $picked]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateState(Request $request) {
    	$request->validate(
    		[
    			'name' => 'required|max:150'
    		]
    	);
    	$picked = State::find($request->state_id);
    	$picked->update(
    		[
    			'name' => $request->name
    		]
    	);
    	return redirect()->back()->with('success', 'State Updated Successfully.');
    }

    public function deleteState(Request $request) {
    	State::find($request->id)->delete();
    	return 'State Deleted Successfully.';
    }

    public function manageCities($id = null) {
    	$states = State::where('country_id', 101)->orderBy('name', 'ASC')->get();
    	return view('admin.state.manage_cities', compact('id', 'states'));
    }

    public function manageCitiesDatatable(Request $request, $id = null) {
    	if ($request->ajax()) {
    		if($id != 'all') {
	    		$cities = City::where('state_id', $id)->get();
                return Datatables::of($cities)
                    ->addIndexColumn()
                    ->addColumn('state_name', function($row){
                        $state = State::find($row->state_id);
                        return $state ? $state->name : '';
                    })
                    ->addColumn('location_count', function($row){
                        return '<a href="'.route('admin.locations.index',['city_id' => $row->id]).'">'.$row->location.'</a>';
                    })
                    ->addColumn('action', function($row){
                        return '<ul class="action">
                                    <li><a href="'.route('admin.locations.index', ['city_id' => $row->id]).'" title="Manage Locations"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                                    <li>
                                        <a href="#" title="Edit City" onclick="fetchData('.$row->id.')"><i class="fas fa-edit"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" title="Delete City" onclick="deleteCity('.$row->id.')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </li>
                                </ul>';
                    })
                    ->rawColumns(['action', 'location_count'])
                    ->make(true);
	    	}else {
	    		City::orderBy('id', 'ASC')->chunk(2000, function($rows) {
                    $cities = [];
                    foreach($rows as $city) {
                        $s['id']       = $city->id;
                        $s['state_id'] = $city->state_id;
                        $s['name']     = $city->name;
                        $s['location'] = $city->location;
                        array_push($cities, $s);
                    }
                    return Datatables::of($cities)
                        ->addIndexColumn()
                        ->addColumn('state_name', function($row){
                            $state = State::find($row['state_id']);
                            return $state ? $state->name : '';
                        })
                        ->addColumn('location_count', function($row){
                            return '<a href="'.route('admin.locations.index',['city_id' => $row['id']]).'">'.$row['location'].'</a>';
                        })
                        ->addColumn('action', function($row){
                            return '<ul class="action">
                                        <li><a href="'.route('admin.locations.index', ['city_id' => $row['id']]).'" title="Manage Locations"><i class="fa fa-list" aria-hidden="true"></i></a></li>
                                        <li>
                                            <a href="#" title="Edit City" onclick="fetchData('.$row['id'].')"><i class="fas fa-edit"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" title="Delete City" onclick="deleteCity('.$row['id'].')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>';
                        })
                        ->rawColumns(['action', 'location_count'])
                        ->make(true);
                });
	    	}
        }
    }

    public function createCity(Request $request) {
    	$request->validate(
    		[
    			'state' => 'required',
    			'name'  => 'required|max:150'
    		]
    	);
    	$state = State::find($request->state);
    	City::create(
    		[
    			'state_id' => $request->state,
    			'name'     => $request->name
    		]
    	);
    	$count = City::where('state_id', $request->state)->count();
    	$state->update(
    		[
    			'total_cities' => $count
    		]
    	);
    	return redirect()->back()->with('success', 'City Added Successfully.');
    }

    public function cityInfo($id) {
    	try {
            $data['city']   = City::find($id);
            $data['states'] = State::where('country_id', 101)->get();
            if($data) {
                $this->JsonResponse(200, 'Data found successfully', ['data' => $data]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateCity(Request $request) {
    	$request->validate(
    		[
    			'state' => 'required',
    			'name'  => 'required|max:150'
    		]
    	);
    	$picked = City::find($request->city_id);
    	$picked->update(
    		[
    			'state_id' => $request->state,
    			'name'     => $request->name
    		]
    	);
    	return redirect()->back()->with('success', 'City Updated Successfully.');
    }

    public function deleteCity(Request $request) {
    	$city = City::find($request->id);
    	$state = State::find($city->state_id);
    	$city->delete();
    	$count = City::where('state_id', $state->id)->count();
    	$state->update(
    		[
    			'total_cities' => $count
    		]
    	);
    	return 'City Deleted Successfully';
    }
}
