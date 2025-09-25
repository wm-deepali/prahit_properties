<?php

namespace App\Http\Controllers\Admin\Ads;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\Locations;
use App\Ad_Audience;
use App\Audience_Location;

class AudienceController extends AppController {

	public function index() {
		$audience = Ad_Audience::latest()->get();
		return view('admin.ads.audience.index', compact('audience'));
	}

	public function create() {
		$location = Locations::all();
		return view('admin.ads.audience.create', compact('location'));
	}

	public function store(Request $request) {
		$rules = [
			'name' => 'required|unique:ad_audience,name',
			'location_id' => 'required',
			'min_age_group' => 'required',
			'max_age_group' => 'required',
			'gender' => 'required',
			'language' => 'required',
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$request['user_id'] = Auth::user()->id;
			$request['gender'] = implode($request->gender, ',');
			$request['language'] = implode($request->language, ',');

			$adObj = Ad_Audience::create($request->all());
			if($adObj->exists()){
				foreach ($request->location_id as $key => $value) {
					$adLocation = Audience_Location::create(['audience_id' => $adObj->id, 'location_id' => $value]);
				}
				if($adLocation->exists()) {
					$this->JsonResponse(200, 'Audience created successfully', []);
				} else {
					$this->JsonResponse(400, 'An error occured');
				}
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}

	}

	public function show($id) {
		$category = Category::findOrFail($id);
		$this->JsonResponse(200, 'Category found successfully', ['Category' => $category]);
	}

	public function update(Request $request, $id) {
		$rules = [
			'category_name' => 'required|unique:categories,category_name,'.$request->category_id,
			'category_slug' => 'required',
			'category_meta_title' => 'required',
			'category_meta_description' => 'required',
			'category_keywords' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			if($request->category_slug == "") {
				$request['category_slug']  = str_replace(" ", "-", $request->category_name);
			}
			$category = Category::find($request->category_id)->update($request->all());
			if($category) {
				$this->JsonResponse(200, 'Category updated successfully', ['Category' => $category]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}

	}

	public function destroy($id) {
		try {
			$delete = Category::find($id)->delete();
			if($delete) {
				$this->JsonResponse(200, 'Category deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function fetch_category_tree() {
		try {
			$sel_cat = $_GET['cat'];
			if($sel_cat == "all") {
				$categories = Category::query();
			} else {
				$categories = Category::query()->where('id', $sel_cat);
			}
			$categories = $categories->with(['Subcategory', 'Subcategory.Subsubcategory'])->get();
			$this->JsonResponse(200, '', ['CategoryTree' => $categories]);
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}
}

