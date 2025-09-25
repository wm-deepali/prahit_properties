<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertiesFields extends Model {
	protected $fillable = [
		'property_id', 'formtype_id', 'sub_feature_id', 'feature_value'
	];

	public function Category() {
		return $this->hasOne('App\Category', 'id', 'category_id');
	}

	public function Location() {
		return $this->hasOne('App\Locations', 'id', 'location_id');
	}

	public function SubFeatures() {
		return $this->hasMany('App\SubFeatures','id','sub_feature_id');
	}

	// public function Properties() {
	// 	return $this->belongsTo('App\Properties', 'property_id', 'id');
	// }
}
