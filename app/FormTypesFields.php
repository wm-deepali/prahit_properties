<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormTypesFields extends Model
{
	protected $fillable = [
		'formtype_id', 'feature_id', 'sub_feature_enabled', 'sub_feature_position'
	];

	protected $table = "formtype_fields";

	// public function SubFeatures() {
	// 	return $this->hasMany('App\SubFeatures', 'id', 'sub_feature_enabled');
	// }

	public function SubFeatures() {
		return $this->hasOne('App\SubFeatures', 'id', 'sub_feature_enabled');
	}
	public function Features() {
		return $this->belongsTo('App\Features','feature_id','id');
	}
	public function FormType() {
		return $this->belongsTo('App\FormType', 'formtype_id', 'id');
	}
}
