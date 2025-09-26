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
use Illuminate\Validation\Rule;

class SubSubCategoryController extends AppController
{

	public function index()
	{
		$categories = Category::latest()->get();
		$subsubcategories = SubSubCategory::has('Subcategory')->has('Subcategory.Category')->with(['Subcategory', 'Subcategory.Category'])->latest()->get();
		return view('admin.sub_sub_categories.index', compact('categories', 'subsubcategories'));
	}

	public function store(Request $request)
	{
		$rules = [
			'category_id' => 'required',
			'sub_category_id' => 'required',
			'sub_sub_category_name' => [
				'required',
				Rule::unique('sub_sub_categories')
					->where(function ($query) use ($request) {
						return $query->where('category_id', $request->category_id)
							->where('sub_category_id', $request->sub_category_id);
					}),
			],
			'sub_sub_category_meta_title' => 'required',
			'sub_sub_category_meta_description' => 'required',
			'sub_sub_category_keywords' => 'required',
			'price_label_toggle' => 'required|in:yes,no',
			'property_status_toggle' => 'required|in:yes,no',
			'registration_status_toggle' => 'required|in:yes,no',
			'furnishing_status_toggle' => 'required|in:yes,no',
		];

		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			if (!$request->has('sub_sub_category_slug')) {
				$request['sub_sub_category_slug'] = str_replace(" ", "-", $request->sub_sub_category_name);
			}
			$checkDuplicate = SubSubCategory::where(['category_id' => $request->category_id, 'sub_category_id' => $request->sub_category_id, 'sub_sub_category_name' => $request->sub_sub_category_name])->first();
			if ($checkDuplicate) {
				$this->JsonResponse(400, 'A sub sub category with this name already exists.');
			}

			$subsubcategory = SubSubCategory::create($request->all());
			if ($subsubcategory) {
				$this->JsonResponse(200, 'Sub Sub Category created successfully', ['SubSubCategory' => $subsubcategory]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}

	}

	public function show($id)
	{
		$subcategory = SubSubCategory::findOrFail($id);
		// dd($subcategory->toArray());
		$this->JsonResponse(200, 'Sub Category found successfully', ['SubCategory' => $subcategory]);
	}


	public function edit($id)
	{
		try {
			$subSubCategory = SubSubCategory::findOrFail($id);

			// Optionally, include related category and subcategory info
			$subSubCategory->load('Subcategory.Category');

			return response()->json([
				'status' => 200,
				'message' => 'Sub Sub Category fetched successfully',
				'data' => [
					'SubSubCategory' => $subSubCategory
				]
			]);
		} catch (\Exception $e) {
			return response()->json([
				'status' => 500,
				'message' => 'An error occurred: ' . $e->getMessage()
			]);
		}
	}


	public function update(Request $request, $id)
	{
		// dd($id);
		// echo json_encode($request->all());
		// exit;
		$rules = [
			'category_id' => 'required',
			'sub_category_id' => 'required',
			'sub_sub_category_name' => [
				'required',
				Rule::unique('sub_sub_categories')
				 ->ignore($id) // ignore current record's ID
					->where(function ($query) use ($request) {
						return $query->where('category_id', $request->category_id)
							->where('sub_category_id', $request->sub_category_id);
					}),
			],
			'sub_sub_category_meta_title' => 'required',
			'sub_sub_category_meta_description' => 'required',
			'sub_sub_category_keywords' => 'required',
			'price_label_toggle' => 'required|in:yes,no',
			'property_status_toggle' => 'required|in:yes,no',
			'registration_status_toggle' => 'required|in:yes,no',
			'furnishing_status_toggle' => 'required|in:yes,no',
		];

		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			if ($request->sub_sub_category_slug == "") {
				$request['sub_sub_category_slug'] = str_replace(" ", "-", $request->sub_sub_category_name);
			}
			$subcategory = SubSubCategory::find($request->sub_sub_category_id)->update($request->all());
			if ($subcategory) {
				$this->JsonResponse(200, 'Sub Category updated successfully', ['SubCategory' => $subcategory]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}

	}

	public function destroy($id)
	{
		try {
			$delete = SubSubCategory::find($id)->delete();
			if ($delete) {
				$this->JsonResponse(200, 'Sub Sub Category deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

}

