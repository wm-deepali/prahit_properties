<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\LoginLogs;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use Illuminate\Http\Request;
use App\WebDirectoryCategory;
use App\WebDirectorySubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Validator;

class WebDirectorySubCategoryController extends AppController {

	public function index() {
		$datas = WebDirectorySubCategory::with(
			[
				'WebDirectoryCategory', 
				'getPropertyCategory',
				'getPropertySubCategory',
				'getPropertySubSubCategory'
			])->latest()->get();
		return view('admin.web_directory.sub_categories.index', compact('datas'));
	}

	public function create() { 
		$categories = WebDirectoryCategory::latest()->get();
		$category   = Category::latest()->get();
		return view('admin.web_directory.sub_categories.add', compact('categories', 'category'));
	}

	public function store(Request $request) {
		$rules = [
			"category_id"          => "required",
			"sub_category_name"    => "required|max:200",
			"sub_category_slug"    => "required|unique:web_directory_sub_categories,sub_category_slug",
			"property_category_id" => "required",
			"sub_category_id"      => "required",
			"sub_sub_category_id"  => "nullable"
		];
		$isValid = $this->checkValidate($request, $rules);
		if($isValid) {
			$this->JsonResponse(400, $isValid);
		}

		try {
			WebDirectorySubCategory::create(
				[
					'category_id'         => $request->category_id,
					'sub_category_name'   => $request->sub_category_name,
					'sub_category_slug'   => $request->sub_category_slug,
					'property_category_id'=> $request->property_category_id,
					'sub_category_id'     => $request->sub_category_id,
					'sub_sub_category_id' => $request->sub_sub_category_id,
					'status'              => 'Yes'
				]
			);
			return redirect('master/web-directory-sub-category')->with('alert-success', 'Sub Category Created Successfully.');
			
		} catch (\Exception $e) {
			echo $e->getMessage();
			exit;
		}

	}

	public function editView($id) {
		$picked = WebDirectorySubCategory::find($id);
		$p_categories = Category::get();
		$p_sub_categories = SubCategory::where('category_id', $picked->property_category_id)->get();
		$p_sub_sub_categories = SubSubCategory::where('category_id', $picked->property_category_id)
			->where('sub_category_id', $picked->sub_category_id)
			->get();
		$categories = WebDirectoryCategory::get();
		return view('admin.web_directory.sub_categories.edit', compact(['picked', 'p_categories', 'p_categories', 'p_sub_categories', 'p_sub_sub_categories', 'categories']));

	}

	public function update(Request $request, $id) {
		$request->validate(
			[
				"category_id"          => "required",
				"sub_category_name"    => "required|max:200",
				"sub_category_slug"    => "required|unique:web_directory_sub_categories,sub_category_slug,".$id,
				"property_category_id" => "required",
				"sub_category_id"      => "required",
				"sub_sub_category_id"  => "nullable"
			]
		);
		$picked = WebDirectorySubCategory::find($id);
		$picked->update(
			[
				'category_id'         => $request->category_id,
				'sub_category_name'   => $request->sub_category_name,
				'sub_category_slug'   => $request->sub_category_slug,
				'property_category_id'=> $request->property_category_id,
				'sub_category_id'     => $request->sub_category_id,
				'sub_sub_category_id' => $request->sub_sub_category_id,
			]
		);
		return redirect('master/web-directory-sub-category')->with('alert-success', 'Sub Category Updated Successfully.');
	}	

	public function destroy($id) {
		try {
			$delete = WebDirectorySubCategory::find($id)->delete();
			if($delete) {
				$this->JsonResponse(200, 'Sub Category deleted successfully');
			} else {
				$this->JsonResponse(400, 'An error occured');
			}
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}
}

