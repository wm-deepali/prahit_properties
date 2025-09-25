<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\PropertyTypes;
use App\Locations;
use App\LoginLogs;
use App\User;
use App\Category;

class CategoryController extends AppController {

	public function index() {
		$categories = Category::latest()->get();
		return view('admin.categories.index', compact('categories'));
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
			$checkDuplicate = Category::where('category_name', $request->category_name)->first();
			if($checkDuplicate) {
				$this->JsonResponse(400, 'A category with this name already exists.');
			}

			if(!$request->has('category_slug')) {
				$request['category_slug']  = str_replace(" ", "-", $request->category_name);
			}
			$category = Category::create($request->all());
			if($category) {
				$this->JsonResponse(200, 'Category created successfully', ['Category' => $category]);
			} else {

				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
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

	public function getAllCategories(Request $request) {
		$search = $request->search;
		if($search) {
			$categories = Category::where('category_name', 'LIKE', '%'.$search.'%')->get();
		}else {
			$categories = Category::get();
		}
		return $categories;
	}

	public function getAllLocations(Request $request) {
		$search = $request->search;
		if($search) {
			$locations = Locations::where('location', 'LIKE', '%'.$search.'%')->get();
		}else {
			$locations = Locations::get();
		}
		return $locations;
	}

	public function getAllPropertyTypes(Request $request) {
		$search = $request->search;
		if($search) {
			$types = PropertyTypes::where('type', 'LIKE', '%'.$search.'%')->get();
		}else {
			$types = PropertyTypes::get();
		}
		return $types;
	}
}

