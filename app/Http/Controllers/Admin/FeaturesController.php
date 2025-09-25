<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\Features;
use App\SubFeatures;
use App\Category;

class FeaturesController extends AppController {

	public function index() {
		$features = Features::latest()->get();
		return view('admin.features.index', compact('features'));
	}

	public function store(Request $request) {
		$rules = [
			'feature_name' => 'required|unique:features,feature_name,'.$request->feature_name,
			'input_type' => 'required',
			'input_selectable' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$features = Features::create($request->all());
			if($features) {
				$this->JsonResponse(200, 'Feature created successfully', ['Feature' => $features]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}

	}

	public function show($id) {
		$features = Features::findOrFail($id);
		$this->JsonResponse(200, 'Features found successfully', ['Feature' => $features]);
	}

	public function edit($id) {
		$features = Features::with('SubFeatures')->find(base64_decode($id));
		return view('admin.features.edit', compact('features'));
	}

	public function update(Request $request, $id) {
		$rules = [
			'feature_name' => 'required|unique:features,feature_name,'.$request->feature_id,
			'input_type' => 'required',
			'input_selectable' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}
		try {
			$Features = Features::find($request->feature_id)->update($request->all());
			if($Features) {
				$this->JsonResponse(200, 'Features updated successfully', ['Features' => $Features]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}

	public function edit_features_access(Request $request) {
		$categories = Category::all();
		return view('admin.features.edit_features_access',compact('categories'));
	}

	public function show_subfeatures($id) {
		$features = SubFeatures::findOrFail($id);
		$this->JsonResponse(200, 'Sub Feature found successfully', ['SubFeature' => $features]);
	}

	public function create_subfeature(Request $request) {
		$rules = [
			'feature_id' => 'required',
			'sub_feature_name' => 'required',
			'sub_feature_slug' => 'required',
			'sub_feature_meta_title' => 'required',
			'sub_feature_meta_description' => 'required',
			'sub_feature_keywords' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}
		try {
			$subfeature = SubFeatures::create($request->all());
			if($subfeature) {
				$this->JsonResponse(200, 'Sub Feature created successfully', ['SubFeatures' => $subfeature]);
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, 'An error occured');
		}
	}

	public function update_subfeature(Request $request, $id) {
		$rules = [
			'sub_feature_id' => 'required',
			'sub_feature_name' => 'required',
			'sub_feature_slug' => 'required',
			'sub_feature_meta_title' => 'required',
			'sub_feature_meta_description' => 'required',
			'sub_feature_keywords' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}
		try {
			$subfeature = SubFeatures::find($request->sub_feature_id)->update($request->all());
			if($subfeature) {
				$this->JsonResponse(200, 'Sub Feature updated successfully', ['SubFeatures' => $subfeature]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, 'An error occured');
		}
	}

	public function destroy($id) {
		try {
			$delete = Features::find($id)->delete();
			if($delete) {
				$this->JsonResponse(200, 'Feature deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

}

