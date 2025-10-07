<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SubSubCategory;
use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use App\Form;

class CustomFormController extends Controller
{
	public function create(Request $request)
	{
		// try {
		$category_id = $request->categories;
		$sub_category_id = $request->subcategories; // single value
		$sub_sub_categories = $request->sub_sub_categories ?? []; // array of sub-sub-categories

		// If sub_sub_categories exist, create a form for each
		if (!empty($sub_sub_categories)) {
			foreach ($sub_sub_categories as $sub_sub_cat_id) {
				$picked = Form::where('category_id', $category_id)
					->where('sub_category_id', $sub_category_id)
					->where('sub_sub_category_id', $sub_sub_cat_id)
					->first();

				if ($picked) {
					$sub_sub_cat = SubSubCategory::find($picked->sub_sub_category_id);
					$this->JsonResponse(500, 'Form Already Added In ' . $sub_sub_cat->sub_sub_category_name);
				}

				Form::create([
					'name' => $request->name,
					'category_id' => $category_id,
					'sub_category_id' => $sub_category_id,
					'sub_sub_category_id' => $sub_sub_cat_id,
					'form_data' => $request->form_data
				]);
			}
		} else if ($sub_category_id) {
			// Only sub_category selected, no sub_sub_category
			$picked = Form::where('category_id', $category_id)
				->where('sub_category_id', $sub_category_id)
				->whereNull('sub_sub_category_id')
				->first();

			if ($picked) {
				$sub_cat = SubCategory::find($picked->sub_category_id);
				$this->JsonResponse(500, 'Form Already Added In ' . $sub_cat->sub_category_name);
			}

			Form::create([
				'name' => $request->name,
				'category_id' => $category_id,
				'sub_category_id' => $sub_category_id,
				'form_data' => $request->form_data
			]);
		} else {
			// Only category selected
			$picked = Form::where('category_id', $category_id)
				->whereNull('sub_category_id')
				->whereNull('sub_sub_category_id')
				->first();

			if ($picked) {
				$cat = Category::find($picked->category_id);
				$this->JsonResponse(500, 'Form Already Added In ' . $cat->category_name);
			}

			Form::create([
				'name' => $request->name,
				'category_id' => $category_id,
				'form_data' => $request->form_data
			]);
		}

		$this->JsonResponse(200, 'Form Created Successfully.');
		// } catch (\Exception $e) {
		// 	$this->JsonResponse(500, $e->getMessage());
		// }
	}


	public function formView($id)
	{
		$data = Form::find($id);
		return view('admin.formtype.view', compact('data'));
	}

	public function formEditView($id)
	{
		$data = Form::find($id);
		$categories = Category::all();
		$sub_categories = SubCategory::where('category_id', $data->category_id)->get();
		$sub_sub_categories = SubSubCategory::whereIn('sub_category_id', explode(',', $data->sub_category_id))->get();
		return view('admin.formtype.form_edit', compact(['data', 'categories', 'sub_categories', 'sub_sub_categories']));
	}

	public function customFormUpdate(Request $request)
	{
		try {
			$category_id = $request->categories;
			$sub_category_id = $request->subcategories; // single value
			$sub_sub_category_id = $request->sub_sub_category; // single value or null

			// Find the form
			$picked = Form::find($request->id);
			if (!$picked) {
				return $this->JsonResponse(404, 'Form not found.');
			}

			// Check for conflicts
			$existsQuery = Form::where('category_id', $category_id)
				->where('sub_category_id', $sub_category_id ?? null)
				->where('sub_sub_category_id', $sub_sub_category_id ?? null)
				->where('id', '!=', $request->id)
				->first();

			if ($existsQuery) {
				if ($sub_sub_category_id) {
					$sub_sub_cat = SubSubCategory::find($sub_sub_category_id);
					return $this->JsonResponse(500, 'Cannot update. Form already exists in ' . $sub_sub_cat->sub_sub_category_name);
				} elseif ($sub_category_id) {
					$sub_cat = SubCategory::find($sub_category_id);
					return $this->JsonResponse(500, 'Cannot update. Form already exists in ' . $sub_cat->sub_category_name);
				} else {
					$cat = Category::find($category_id);
					return $this->JsonResponse(500, 'Cannot update. Form already exists in ' . $cat->category_name);
				}
			}

			// Update the form
			$picked->update([
				'name' => $request->name,
				'category_id' => $category_id,
				'sub_category_id' => $sub_category_id,
				'sub_sub_category_id' => $sub_sub_category_id,
				'form_data' => $request->form_data
			]);

			return $this->JsonResponse(200, 'Form Updated Successfully.');
		} catch (\Exception $e) {
			return $this->JsonResponse(500, $e->getMessage());
		}
	}

	public function deleteCustomForm(Request $request)
	{
		try {
			$picked = Form::find($request->id)->delete();
			$this->JsonResponse(200, 'Form Deleted Successfully.');
		} catch (\Exception $e) {
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function formChangeStatus(Request $request)
	{
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
			$this->JsonResponse(500, $e->getMessage());
		}
	}

	public function categoryRelatedForm(Request $request)
	{
		$query = Form::where('category_id', $request->category);

		if ($request->has('sub_category')) {
			$query->where('sub_category_id', $request->sub_category);
		} else {
			$query->whereNull('sub_category_id');
		}

		if ($request->has('sub_sub_category')) {
			$query->where('sub_sub_category_id', $request->sub_sub_category);
		} else {
			$query->whereNull('sub_sub_category_id');
		}

		$picked = $query->first();

		return $picked ? $picked : 0;
	}

}
