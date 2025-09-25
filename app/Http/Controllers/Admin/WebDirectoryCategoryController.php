<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\WebDirectoryCategory;

class WebDirectoryCategoryController extends AppController {

	public function index() {
		$categories = WebDirectoryCategory::latest()->get();
		return view('admin.web_directory.categories.index', compact('categories'));
	}

	public function store(Request $request) {
		$rules = [
			'category_name' => 'required',
			// 'category_slug' => 'required',
			'category_meta_title' => 'required',
			'category_meta_description' => 'required',
			'category_keywords' => 'required'
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			$checkDuplicate = WebDirectoryCategory::where('category_name', $request->category_name)->first();
			if($checkDuplicate) {
				$this->JsonResponse(400, 'A category with this name already exists.');
			}

			if(!$request->has('category_slug')) {
				$request['category_slug']  = str_replace(" ", "-", $request->category_name);
			}
			$category = WebDirectoryCategory::create($request->all());
			if($category) {
				$this->JsonResponse(200, 'Category created successfully', ['Category' => $category]);
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, 'An error occured');
		}

	}

	public function show($id) {
		$category = WebDirectoryCategory::findOrFail($id);
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
			$category = WebDirectoryCategory::find($request->category_id)->update($request->all());
			if($category) {
				$this->JsonResponse(200, 'Category updated successfully', ['Category' => $category]);
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(599);
		}

	}

	public function destroy($id) {
		try {
			$delete = WebDirectoryCategory::find($id)->delete();
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

