<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model {

	protected $fillable = [
		'property_id',
		'mobile_number',  // ✅ added
		'email',          // ✅ added
		'is_feedback',
		'is_complaint',
		'is_agent_not_reachable',
		'feedback',
		'complaint_type',
		'agent_not_reachable_type',
		'status'
	];

	public function Property(){
		return $this->hasOne('App\Properties','id','property_id');
	}

}
