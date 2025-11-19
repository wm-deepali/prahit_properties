<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use Http;
use App\User;
use App\LoginLogs;
use App\Category;
use App\SubCategory;
use Illuminate\Validation\Rule;


class SubCategoryController extends AppController
{

	public function index()
	{
		$subcategories = SubCategory::has('Category')->with('Category')->paginate(10); // 10 per page
		$categories = Category::all();
		return view('admin.sub_categories.index', compact('subcategories', 'categories'));
	}


	public function store(Request $request)
	{
		$rules = [
			'category_id' => 'required',
			'sub_category_name' => 'required',
			// 'sub_category_slug' => 'required',
			'sub_category_meta_title' => 'required',
			'sub_category_meta_description' => 'required',
			'sub_category_keywords' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$checkDuplicate = SubCategory::where(['category_id' => $request->category_id, 'sub_category_name' => $request->sub_category_name])->first();
			if ($checkDuplicate) {
				$this->JsonResponse(400, 'A sub category with this category & name already exists.');
			}

			if (!$request->has('sub_category_slug')) {
				$request['sub_category_slug'] = str_replace(" ", "-", $request->sub_category_name);
			}
			$subcategory = SubCategory::create($request->all());
			if ($subcategory) {
				$this->JsonResponse(200, 'Category created successfully', ['SubCategory' => $subcategory]);
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
		$subcategory = SubCategory::findOrFail($id);
		$this->JsonResponse(200, 'Sub Category found successfully', ['SubCategory' => $subcategory]);
	}


	public function update(Request $request, $id)
	{
		$rules = [
			'category_id' => 'required',
			'sub_category_name' => [
				'required',
				Rule::unique('sub_categories', 'sub_category_name')
					->ignore($request->sub_category_id)
					->where(function ($query) use ($request) {
						return $query->where('category_id', $request->category_id);
					}),
			],
			'sub_category_meta_title' => 'required',
			'sub_category_meta_description' => 'required',
			'sub_category_keywords' => 'required',
		];

		$isValid = $this->checkValidate($request, $rules);
		if ($isValid) {
			return $this->JsonResponse(400, $isValid);
		}

		try {
			if ($request->sub_category_slug == "") {
				$request['sub_category_slug'] = str_replace(" ", "-", $request->sub_category_name);
			}

			$subcategory = SubCategory::find($request->sub_category_id)
				->update($request->all());

			if ($subcategory) {
				return $this->JsonResponse(200, 'Sub Category updated successfully', ['SubCategory' => $subcategory]);
			} else {
				return $this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}


	public function destroy($id)
	{
		try {
			$delete = SubCategory::find($id)->delete();
			if ($delete) {
				$this->JsonResponse(200, 'Sub Category deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	// public function fetch_subcategories_by_cat_id($id) {
	// 	try {
	// 		$response = Http::get(config('app.api_url')."/fetch_subcategories_by_cat_id/$id");

	// 		if($response->getStatusCode() == 200) {
	// 			$response = json_decode($response->getBody());
	// 			$this->JsonResponse(200, 'SubCategory found successfully', ['SubCategory' => $response->data->SubCategory]);
	// 		} else {
	// 			$this->JsonResponse(400, 'An error occured');
	// 		}
	// 	} catch (\Exception $e) {
	// 		$this->JsonResponse(500, $e->getMessage());
	// 	}
	// }

	public function fetch_multiple_subcategories_by_cat_id()
	{
		try {
			$id_array = isset($_GET['id']) ? $_GET['id'] : "";
			$subcategory = \DB::table('sub_categories')->where('category_id', $id_array)->get();
			$this->JsonResponse(200, '', ['SubCategory' => $subcategory]);
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}
}

