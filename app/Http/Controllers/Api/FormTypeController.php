<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;
use App\Locations;
use App\SubLocations;
use App\Cities;

class FormTypeController extends BaseApiController {

	public function fetch_form_type() {
		try {
			$cat = isset($_GET['cat']) ? $_GET['cat'] : '';
			$sub_cat = isset($_GET['subcat']) ? $_GET['subcat'] : '';
			$edit = isset($_GET['edit']) ? $_GET['edit'] : '';
			$formtype_id = isset($_GET['formtype_id']) ? $_GET['formtype_id'] : '';

			if(isset($edit)) {
				$form = \DB::table('formtypes as formt')
						->leftjoin('form_types_cats', 'formt.id', '=', 'form_types_cats.form_type_id')
						->leftjoin('formtype_fields', 'formt.id', '=', 'formtype_fields.formtype_id')
						->leftjoin('sub_features', 'formtype_fields.sub_feature_enabled', '=', 'sub_features.id')
						->leftjoin('features', 'sub_features.feature_id','=','features.id')
						// ->where('form_types_cats.category_id', 'like', "%$cat%")
						->where('form_types_cats.sub_category_id', 'like', "%$sub_cat%")

						->select('formt.id as formt_id','formtype_fields.*','sub_features.id as sub_f_id','sub_features.sub_feature_name as sub_feature_name','sub_features.sub_feature_slug as sub_feature_slug','features.*','form_types_cats.*')
						->orderBy('formtype_fields.sub_feature_position')
						->get();


				$property = \DB::table('properties')
						->where('properties.category_id', 'like', "%$cat%")
						->where('properties.sub_category_id', 'like', "%$sub_cat%")
						->leftjoin('properties_fields', 'properties.id','=','properties_fields.property_id')
						->get();

			} else {
				$form = \DB::table('formtypes as formt')
						->where('category_id', 'like', "%$cat%")
						->where('sub_category_id', 'like', "%$sub_cat%")
						->leftjoin('formtype_fields', 'formtype_fields.formtype_id','=','formt.id')
						->leftjoin('sub_features', 'formtype_fields.sub_feature_enabled','=','sub_features.id')
						->leftjoin('features', 'sub_features.feature_id','=','features.id')
						->select('formt.id as formt_id','formtype_fields.*','sub_features.id as sub_f_id','sub_features.sub_feature_name as sub_feature_name','sub_features.sub_feature_slug as sub_feature_slug','features.*')
						->orderBy('formtype_fields.sub_feature_position')
						->get();
			}

			$this->_sendResponse(['FormType' => $form,'Property' => $property], 'FormType found successfully');
		} catch (\Exception $e) {
			$this->_sendErrorResponse(500, $e->getMessage());
		}
	}

}

