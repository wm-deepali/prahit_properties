<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\FormTypes;
use App\FormTypesFields;
use App\Features;
use App\Category;
use App\Properties;
use App\FormTypeCats;
use App\Form;

class FormTypeController extends AppController {

	public function index() {
		// $formtypes = FormTypes::has('FormTypeCats.Category')->with('FormTypeCats.Category')->latest()->get();
		// // return $formtypes;
		// $cats = [];
		// foreach ($formtypes as $key => $value) {
		// 	foreach ($value->FormTypeCats as $key1 => $value1) {
		// 		if($value1->category) {
		// 			// echo json_encode($value1->category->category_name);
		// 			array_push($cats, $value1->category->category_name);
		// 		}
		// 	}
		// 	$value->cats = $cats;
		// 	$cats = [];					
		// }
		// return $formtypes;
		$category = Category::all();
		$formtypes = Form::get(); 
		return view('admin.formtype.index', compact('formtypes'));
	}


	public function create() {
		$categories = Category::all();
		$features = Features::with('SubFeatures')->get();
		return view('admin.formtype.add', compact('features','categories'));
	}

	public function store(Request $request) {
		$rules = [
			'form_name' => 'required|unique:formtypes,form_name,'.$request->form_name,
			'assigned_to' => 'required', // category
			'sub_category_id' => "required",		
			'sub_feature_position' => 'required',
			'sub_feature_enabled' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) { 
			$this->JsonResponse(400, $isValid);
		}

		try {
			$feature_enabled = array_filter($request->sub_feature_enabled);
			$feature_position = array_filter($request->sub_feature_position);

			$formtype = FormTypes::create($request->all());

			if($request->assigned_to) {
				foreach ($request->assigned_to as $key => $value) {
					$cats = FormTypeCats::create(['form_type_id' => $formtype->id, 'category_id' => $value]);
				}

				foreach ($request->sub_category_id as $key => $value) {
					$subcats = FormTypeCats::create(['form_type_id' => $formtype->id, 'sub_category_id' => $value, 'form_name' => $value]);
				}

				foreach (array_combine($feature_enabled, $feature_position) as $position => $feature) {
					FormTypesFields::create(['formtype_id' => $formtype->id, 'sub_feature_enabled' => $position, 'sub_feature_position' => $feature]);
				}

				$this->JsonResponse(200, 'FormType created successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}


	public function edit($id) {
		$formtype = FormTypes::with(['FormTypesFields','FormTypeCats:id,form_type_id,category_id,sub_category_id'])->find(base64_decode($id));
		$selected_categories = [];
		$selected_sub_categories = [];
		foreach ($formtype->FormTypeCats as $key => $value) {
			array_push($selected_categories, $value->category_id);
		}
		foreach ($formtype->FormTypeCats as $key => $value) {
			array_push($selected_sub_categories, $value->sub_category_id);
		}

		// $selected_categories = explode(',', $formtype->category_id);
		$selected_subfeatures = [];
		$selected_subfeatures_position = [];
		foreach ($formtype->formtypesfields as $key => $value) {
			array_push($selected_subfeatures, $value->sub_feature_enabled);
			$selected_subfeatures_position['sub_feature_id_'.$value->sub_feature_enabled] = $value->sub_feature_position;
		}
		// // echo json_encode($selected_subfeatures_position);
		// exit;
		// dd($formtype);

		$categories = Category::all();
		$features = Features::with('SubFeatures')->get();
		return view('admin.formtype.edit', compact('formtype','categories','features','selected_categories','selected_subfeatures','selected_subfeatures_position','selected_sub_categories'));
	}

	public function update(Request $request, $id) {
		$request->form_name = str_replace(' ', '', $request->form_name);
		$request->form_name = rtrim($request->form_name);
		$request->form_name = ltrim($request->form_name);

		$rules = [
			'form_name' => 'required|unique:formtypes,form_name,'.$request->id,
			'assigned_to' => 'required', // category
			'sub_category_id' => "required",		
			'sub_feature_position' => 'required',
			'sub_feature_enabled' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$feature_enabled = array_filter($request->sub_feature_enabled);
			$feature_position = array_filter($request->sub_feature_position);

			// if(count($feature_enabled) !== count($feature_position)) {
			// 	$this->JsonResponse(400, 'Please provide position and enable/disable for all values.');
			// }

			$formtype = FormTypes::find($request->id)->update($request->all());

			if($request->assigned_to) {

				FormTypeCats::where('form_type_id',$request->id)->delete();
				FormTypesFields::where('formtype_id',$request->id)->delete();

				foreach ($request->assigned_to as $key => $value) {
					$cats = FormTypeCats::updateOrCreate(
						['form_type_id' => $request->id, 'category_id' => $value],
						['form_type_id' => $request->id, 'category_id' => $value]						
					);
				}

				foreach ($request->sub_category_id as $key => $value) {
					$subcats = FormTypeCats::updateOrCreate(
						['form_type_id' => $request->id, 'sub_category_id' => $value],
						['form_type_id' => $request->id, 'sub_category_id' => $value]
					);
				}

				// PropertiesFields::where('formtype_id',$request->id)->delete();
				foreach (array_combine($feature_enabled, $feature_position) as $position => $feature) {
					FormTypesFields::create(
						['formtype_id' => $request->id, 'sub_feature_enabled' => $position, 'sub_feature_position' => $feature]
					);
				}

				$this->JsonResponse(200, 'FormType updated successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
				$this->JsonResponse(500, $e->getMessage());
		}

	}

	public function destroy($id) {
		try {
			$picked = FormTypes::find($id);
			FormTypesFields::where('formtype_id', $picked->id)->delete();
			FormTypeCats::where('form_type_id', $picked->id)->delete();
			if($picked) {
				$picked->delete();
				$this->JsonResponse(200, 'FormType deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function category_to_formtype_availablity($cats, $subcats) {
		try {
			$is_available = FormTypes::whereIn('category_id', [$cats])->where('sub_category_id', $subcats)->count();
			if($is_available === 0) {
				$this->JsonResponse(200,'is available');
			} else {
				$this->JsonResponse(400,'FormType is already created for selected category and sub category.');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

}

