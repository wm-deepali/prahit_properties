<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormTypeCats extends Model {

	protected $fillable = ['form_type_id','category_id','sub_category_id'];


	protected $table = 'form_types_cats';

	public $timestamps = false;

	public function Category() {
		return $this->hasOne('App\Category','id','category_id');
	}
}
