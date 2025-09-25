<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubFeatures extends Model
{
	protected $fillable = [
		'feature_id', 'sub_feature_name', 'sub_feature_slug', 'sub_feature_meta_title', 'sub_feature_meta_description', 'sub_feature_keywords'
	];

	public function Features() {
		return $this->belongsTo('App\Features','feature_id','id');
	}

	public function FormTypesFields() {
		return $this->hasMany('App\FormTypesFields', 'id', 'sub_feature_id');
	}

	public function PropertyFeatures() {
		return $this->hasOne('App\PropertiesFields', 'sub_feature_id', 'id');
	}
}
