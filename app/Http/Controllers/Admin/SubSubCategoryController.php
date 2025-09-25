<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;

class SubSubCategoryController extends AppController {

	public function index() {
		$categories = Category::latest()->get();
		$subsubcategories = SubSubCategory::has('Subcategory')->has('Subcategory.Category')->with(['Subcategory', 'Subcategory.Category'])->latest()->get();
		return view('admin.sub_sub_categories.index', compact('categories','subsubcategories'));
	}

	public function store(Request $request) {
		$rules = [
			'category_id' => 'required',
			'sub_category_id' => 'required',
			'sub_sub_category_name' => 'required',
			// 'sub_sub_category_slug' => 'required',
			'sub_sub_category_meta_title' => 'required',
			'sub_sub_category_meta_description' => 'required',
			'sub_sub_category_keywords' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			if(!$request->has('sub_sub_category_slug')) {
				$request['sub_sub_category_slug']  = str_replace(" ", "-", $request->sub_sub_category_name);
			}
			$checkDuplicate = SubSubCategory::where(['category_id' => $request->category_id, 'sub_category_id' => $request->sub_category_id,'sub_sub_category_name' => $request->sub_sub_category_name])->first();
			if($checkDuplicate) {
				$this->JsonResponse(400, 'A sub sub category with this name already exists.');
			}

			$subsubcategory = SubSubCategory::create($request->all());
			if($subsubcategory) {
				$this->JsonResponse(200, 'Sub Sub Category created successfully', ['SubSubCategory' => $subsubcategory]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}

	}

	public function show($id) {
		$subcategory = SubSubCategory::findOrFail($id);
		$this->JsonResponse(200, 'Sub Category found successfully', ['SubCategory' => $subcategory]);
	}

	public function update(Request $request, $id) {
		// echo json_encode($request->all());
		// exit;
		$rules = [
			'category_id' => 'required',
			'sub_category_id' => 'required',
			'sub_sub_category_name' => 'required|unique:sub_sub_categories,sub_sub_category_name,'.$request->sub_sub_category_id,
			// 'sub_sub_category_slug' => 'required',
			'sub_sub_category_meta_title' => 'required',
			'sub_sub_category_meta_description' => 'required',
			'sub_sub_category_keywords' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			if($request->sub_sub_category_slug == "") {
				$request['sub_sub_category_slug']  = str_replace(" ", "-", $request->sub_sub_category_name);
			}
			$subcategory = SubSubCategory::find($request->sub_sub_category_id)->update($request->all());
			if($subcategory) {
				$this->JsonResponse(200, 'Sub Category updated successfully', ['SubCategory' => $subcategory]);
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
			$delete = SubSubCategory::find($id)->delete();
			if($delete) {
				$this->JsonResponse(200, 'Sub Sub Category deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

}

