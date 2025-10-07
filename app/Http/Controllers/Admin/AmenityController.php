<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Amenity;

class AmenityController extends Controller
{
    public function manageAmenities() {
    	$amenities = Amenity::orderBy('id', 'DESC')->paginate(10);
    	return view('admin.amenities.index', compact('amenities'));
    }

    public function createAmenities(Request $request) {
    	$request->validate(
    		[
    			'image' => 'required|mimes:jpg,png,jpeg,svg',
    			'name'  => 'required|max:200'
    		]
    	);
    	if($request->hasFile('image')){
            $path = $request->image->store('amenities');
        }
        Amenity::create(
        	[
        		'icon' => $path,
        		'name' => $request->name
        	]
        );
        return redirect()->back()->with('success', 'Amenity Created Successfully.');
    }

    public function getAmenitiesData($id) {
    	try {
            $picked = Amenity::find($id);
            if($picked) {
                $this->JsonResponse(200, 'Amenity updated successfully', ['picked' => $picked]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateAmenities(Request $request) {
    	$request->validate(
    		[
    			'image' => 'nullable|mimes:jpg,png,jpeg,svg',
    			'name'  => 'required|max:200'
    		]
    	);
    	$picked = Amenity::find($request->amenity_id);
    	if($request->hasFile('image')){
            $path = $request->image->store('amenities');
            Storage::delete($picked->icon);
        }else {
        	$path = $picked->icon;
        }
        $picked->update(
        	[
        		'icon' => $path,
        		'name' => $request->name
        	]
        );
        return redirect()->back()->with('success', 'Amenity Updated Successfully.');
    }

    public function chnageStatusAmenities(Request $request) {
    	$picked = Amenity::find($request->id);
        $status = $picked->status == 'Yes' ? 'No' : 'Yes';
        $msg    = $picked->status == 'Yes' ? 'Amenity Blocked Successfully.' : 'Amenity Activated Successfully.';
        $picked->update(
            [
                'status' => $status
            ]
        );
        return $msg;
    }

    public function deleteAmenities($id) {
        try {
            $picked = Amenity::find($id)->delete();
            if($picked) {
                $this->JsonResponse(200, 'Amenity deleted successfully');
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
