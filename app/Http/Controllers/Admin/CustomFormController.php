<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormFeatureSetting;
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

	public function manageFeatures($id)
	{
		$form = Form::findOrFail($id);

		// decode JSON safely
		$rawFields = json_decode($form->form_data ?? '[]', true);

		$normalized = [];

		foreach ($rawFields as $idx => $f) {
			// skip headers/paragraphs unless you want them listed
			if (in_array($f['type'] ?? '', ['header', 'paragraph'])) {
				continue;
			}

			// Prefer the `name` attribute as a stable key; fall back to slugified label + index
			$key = $f['name'] ?? null;
			if (!$key) {
				$labelForKey = isset($f['label']) ? strip_tags($f['label']) : 'field_' . $idx;
				$key = \Str::slug($labelForKey) . '-' . $idx;
			}

			$label = isset($f['label']) ? strip_tags($f['label']) : $key;
			$type = $f['type'] ?? 'text';

			// Determine preview value from userData OR values[].selected OR empty
			$preview = '';

			// userData can be array or single
			if (isset($f['userData'])) {
				$ud = $f['userData'];
				if (is_array($ud)) {
					// multiple values or single inside array
					$preview = implode(', ', array_filter($ud, function ($v) {
						return $v !== null && $v !== '';
					}));
				} else {
					$preview = (string) $ud;
				}
			} elseif (isset($f['values']) && is_array($f['values'])) {
				// look for selected flags in values array
				$selected = [];
				foreach ($f['values'] as $val) {
					if (!empty($val['selected']) || (isset($val['value']) && isset($val['selected']) && $val['selected'])) {
						$selected[] = $val['label'] ?? $val['value'];
					}
				}
				$preview = implode(', ', $selected);
			}

			// For checkbox-group when values present, preview any selected values
			if ($type === 'checkbox-group' && isset($f['values']) && is_array($f['values'])) {
				$selected = [];
				foreach ($f['values'] as $v) {
					if (!empty($v['selected']))
						$selected[] = $v['label'] ?? $v['value'];
				}
				$preview = implode(', ', $selected);
			}

			// For radio-group map selected value->label if userData holds value
			if ($type === 'radio-group' && isset($f['userData'][0]) && isset($f['values'])) {
				$udv = $f['userData'][0];
				foreach ($f['values'] as $v) {
					if (isset($v['value']) && $v['value'] == $udv) {
						$preview = $v['label'] ?? $udv;
						break;
					}
				}
			}

			$normalized[] = [
				'key' => $key,
				'type' => $type,
				'label' => trim($label),
				'preview' => $preview,
				'raw' => $f,
			];
		}

		// load saved settings keyed by field_key
		$saved = FormFeatureSetting::where('form_id', $id)->get()->keyBy('field_key');

		return view('admin.formtype.manage-features', [
			'form' => $form,
			'fields' => $normalized,
			'saved' => $saved,
		]);
	}

	public function saveFeatures(Request $request)
	{
		$formId = $request->form_id;

		// get submitted keys
		$submittedKeys = array_keys($request->label ?? []);

		// fetch existing saved rows
		$existing = FormFeatureSetting::where('form_id', $formId)->get()->keyBy('field_key');

		foreach ($submittedKeys as $key) {

			// skip storing fields that have show_in_front unchecked
			if (!isset($request->show[$key])) {

				// if it exists in DB, delete it
				if ($existing->has($key)) {
					$existing[$key]->delete();
				}

				continue;
			}

			// Prepare data to save
			$data = [
				'label_to_show' => $request->label[$key] ?? null,
				'icon_class' => $request->icon[$key] ?? null,
				'sort_order' => $request->sort[$key] ?? 0,
				'show_in_front' => 1, // only visible fields stored
			];

			// update or insert
			FormFeatureSetting::updateOrCreate(
				['form_id' => $formId, 'field_key' => $key],
				$data
			);

			// remove from existing list so we know it's handled
			if ($existing->has($key)) {
				unset($existing[$key]);
			}
		}

		// delete any leftover settings for fields that no longer exist
		if ($existing->isNotEmpty()) {
			FormFeatureSetting::whereIn('id', $existing->pluck('id'))->delete();
		}

		return redirect()->back()->with('success', 'Features updated successfully!');
	}



}
