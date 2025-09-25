<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model {

	protected $fillable = [
		'user_id', 'name', 'banner_type', 'thumbnail', 'ad_type','start_date','end_date','audience_id','budget','property_id','custom_link'
	];

	public function Property() {
		return $this->hasOne('App\Properties','id','property_id');
	}

}
