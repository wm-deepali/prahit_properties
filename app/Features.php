<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
	protected $fillable = [
		'feature_name','input_type','input_selectable'
	];

	public function SubFeatures() {
		return $this->hasMany('App\SubFeatures','feature_id','id');
	}

}
