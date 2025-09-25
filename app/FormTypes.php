<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormTypes extends Model {
	protected $fillable = [
		 'form_name', 'status'
	];

	protected $table = "formtypes";

	public function FormTypesFields() {
		return $this->hasMany('App\FormTypesFields','formtype_id','id');
	}
	public function FormTypeCats() {
		return $this->hasMany('App\FormTypeCats', 'form_type_id','id');
	}
	public function Properties() {
		return $this->hasOne('App\Properties','formtype_id','id');
	}

}