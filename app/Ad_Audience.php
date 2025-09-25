<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad_Audience extends Model {

	protected $table = "ad_audience";

	protected $fillable = [
		'name', 'user_id', 'gender', 'language','min_age_group','max_age_group'
	];

	public function Location() {
		return $this->hasMany('App/Audience_Location', 'location_id','id');
	}
}
