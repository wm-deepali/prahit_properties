<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use App\User;
use App\LoginLogs;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;

class CategoryController extends BaseApiController {

	public function index() {
		$categories = Category::latest()->get();
		$this->_sendResponse(['Categories' => $categories], 'Categories found successfully');
	}

	public function category_tree() {
		$categories = Category::with('Subcategory','Subcategory.Subsubcategory')->latest()->get();
		$this->_sendResponse(['Categories' => $categories], 'Category tree found successfully');
	}

	public function fetch_subcategories_by_cat_id($id) {
		try {
			$findSubCategories = SubCategory::where('category_id', $id)->get();
			$this->_sendResponse(['SubCategory' => $findSubCategories], 'SubCategory found successfully');
		} catch(\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

	public function fetch_subsubcategories_by_subcat_id($id){
		try {
			$findSubCategories = SubSubCategory::where('sub_category_id', $id)->get();
			$this->_sendResponse(['SubSubCategory' => $findSubCategories], 'SubSubCategory found successfully');
		} catch(\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

}

