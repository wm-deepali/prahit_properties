<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\User;
use App\LoginLogs;
use App\Category;
use App\City;
use App\State;
use App\PopularCity;
use Illuminate\Support\Facades\Storage;

class AdminController extends AppController {
	public function dashboard() {
		$last_login = LoginLogs::where('user_id', Auth::user()->id)->latest()->first();
		return view('admin.dashboard', compact('last_login'));
	}

	public function edit_profile() {
		return view('admin.edit_profile');
	}

	public function update_edit_profile(Request $request) {
		$rules = [
			'firstname' => 'required|max:200',
			'lastname'  => 'required|max:200',
			'email' => 'required|email',
			'mobile_number' => 'required',
			'company_name'  => 'nullable|max:200'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			return redirect()->back()->with('alert-error', $isValid);
		}

		try {
		    if($request->has('avatar_file')) {
		        $profile = $request->avatar_file->store('uploads/users');
		        Storage::delete(\Auth::user()->avatar);
		  //      $newFileName = $this->fileUpload($request, ['uploads/users/' => 'avatar_file']);
			 //   $profile = isset($newFileName[0]) ? $newFileName[0] : '';
		    }else {
			    $profile = \Auth::user()->avatar;
		    }
			$request['company_name'] = $request->company_name;
			\Auth::user()->update(
				[
					'firstname'     => $request->firstname,
					'lastname'      => $request->lastname,
					'email'         => $request->email,
					'mobile_number' => $request->mobile_number,
					'company_name'  => $request->company_name,
					'avatar'        => $profile
				]
			);
			return redirect()->back()->with('alert-success', 'Profile updated successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
		}
	}

	public function update_password(Request $request) {
		$rules = [
			'password' => 'required|same:new_password',
			'new_password' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			return redirect()->back()->with('alert-error', $isValid);
		}

		try {
			$user = User::find(Auth::user()->id);
			$np = Hash::make($request->new_password);
				$user->password = $np;
				$user->save();
				return redirect()->back()->with('alert-success', 'Password updated successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('alert-error', $e->getMessage());
		}
	}

	public function managePopularCities()
	{
		$content = PopularCity::where('slug', 'heading')->first();
		$cities  = PopularCity::where('slug', 'city')->orderBy('id', 'DESC')->get();
		$states  = State::where('country_id', 101)->orderBy('name', 'ASC')->get();
		return view('admin.popular_cities', compact('content', 'states', 'cities'));
	}

	public function popularCityGetContent($id)
	{
		try {
            $data['picked'] = PopularCity::find($id);
            $data['states'] = State::where('country_id', 101)->get();
            $data['cities'] = City::where('state_id', $data['picked']->state_id)->get();
            if($data) {
                $this->JsonResponse(200, 'Data updated successfully', ['picked' => $data]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
	}

	public function createPopularCity(Request $request)
	{
		$count = PopularCity::where('slug', 'city')->count();
		if($count == 6 || $count > 6) {
			return redirect()->back()->with('error', 'You Can Not Add More Then Six Cities.');
		}
		$path = $request->image->store('cities');
		PopularCity::create(
			[
				'slug'      => 'city',
				'state_id'  => $request->state,
				'city_id'   => $request->city,
				'image'     => $path
			]
		);
		return redirect()->back()->with('success', 'City Added Successfully.');
	}

	public function updatePopularCity(Request $request)
	{
		$request->validate(
			[
				'heading' => 'nullable|max:150'
			]
		);
		$picked = PopularCity::find($request->id);
		$heading = $request->has('heading') ? $request->heading : $picked->heading;
		$state   = $request->has('state') ? $request->state : $picked->state_id;
		$city    = $request->has('city') ? $request->city : $picked->city_id;
		if($request->has('image')) {
			$path = $request->image->store('cities');
			Storage::delete($picked->image);
		}else {
			$path = $picked->image;
		}
		$picked->update(
			[
				'state_id'  => $state,
				'city_id'   => $city,
				'image'     => $path,
				'heading'   => $heading
			]
		);
		return redirect()->back()->with('success', 'Content Updated Successfully.');
	}

	public function deletePopularCity($id) {
        try {
            $picked = PopularCity::find($id)->delete();
            if($picked) {
                $this->JsonResponse(200, 'City deleted successfully');
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}

