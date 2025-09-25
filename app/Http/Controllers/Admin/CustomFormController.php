<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use App\Form;

class CustomFormController extends Controller
{
    public function create(Request $request) {
    	try {	
    		if($request->subcategories) {
    			$count = count($request->subcategories);
    			for ($i = 0; $i < $count; $i++) { 
    				$picked = Form::where('category_id', $request->categories)->where('sub_category_id', $request->subcategories[$i])->first();
    				if($picked) {
    					$sub_cat = SubCategory::find($picked->sub_category_id);
    					$this->JsonResponse(500, 'Form Already Added In '.$sub_cat->sub_category_name);
    				}
    				$make = Form::create(
						[ 
							'name'            => $request->name,
					    	'category_id'     => $request->categories,
					    	'sub_category_id' => $request->subcategories[$i],
					    	'form_data'       => $request->form_data
						]
					);
    			}
    		}else {
    			$picked = Form::where('category_id', $request->categories)->where('sub_category_id', null)->first();
				if($picked) {
					$cat = Category::find($picked->category_id);
					$this->JsonResponse(500, 'Form Already Added In '.$cat->category_name);
				}
    			$make = Form::create(
					[ 
						'name'            => $request->name,
				    	'category_id'     => $request->categories,
				    	'form_data'       => $request->form_data
					]
				);
    		}
			$this->JsonResponse(200, 'Form Created Successfully.');
		} catch (\Exception $e) {
			$this->JsonResponse(500,$e->getMessage());
		}
    }

    public function formView($id) {
    	$data = Form::find($id);
    	return view('admin.formtype.view', compact('data'));
    }

    public function formEditView($id) {
    	$data       = Form::find($id);
    	$categories = Category::all();
    	$sub_categories = SubCategory::whereIn('category_id', explode(',', $data->category_id))->get();
    	return view('admin.formtype.form_edit', compact(['data', 'categories', 'sub_categories']));
    }

    public function customFormUpdate(Request $request) {
    	try {	
    		if($request->subcategories) {
    			$check = Form::where('category_id', $request->categories)->where('sub_category_id', $request->subcategories)->whereNotIn('id', [$request->id])->first();
    			if($check) {
    				$this->JsonResponse(500, 'Not Updated, Because Form Already Added On This Category & Sub Category.');
    			}
    		}else {
    			$check = Form::where('category_id', $request->categories)->where('sub_category_id', null)->whereNotIn('id', [$request->id])->first();
    			if($check) {
    				$this->JsonResponse(500, 'Not Updated, Because Form Already Added On This Category');
    			}
    		}
    		$picked = Form::find($request->id);
			$picked->update(
				[
					'name'            => $request->name,
			    	'category_id'     => $request->categories,
			    	'sub_category_id' => $request->subcategories,
			    	'form_data'       => $request->form_data
				]
			);
			$this->JsonResponse(200, 'Form Updated Successfully.');
		} catch (\Exception $e) {
			$this->JsonResponse(500,$e->getMessage());
		}
    }

    public function deleteCustomForm(Request $request) {
    	try {	
    		$picked = Form::find($request->id)->delete();
			$this->JsonResponse(200, 'Form Deleted Successfully.');
		} catch (\Exception $e) {
			$this->JsonResponse(500,$e->getMessage());
		}
    }

    public function formChangeStatus(Request $request) {
    	try {	
			$picked = Form::find($request->id);
			$status = $picked->status == 'Yes' ? 'No' : 'Yes';
			$picked->update(
				[
					'status' => $status
				]
			);
			$this->JsonResponse(200, 'Form Status Changed successfully');
		} catch (\Exception $e) {
			$this->JsonResponse(500,$e->getMessage());
		}
    }

    public function categoryRelatedForm(Request $request) {
		if($request->has('sub_category')) {
			$picked = Form::where('category_id', $request->category)->where('sub_category_id', $request->sub_category)->first();
		}else {
			$picked = Form::where('category_id', $request->category)->where('sub_category_id', null)->first();
		}
		return $picked ? $picked : 0;
    }
}
