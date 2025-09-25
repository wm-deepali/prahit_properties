<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model {

	// protected $table = "feedback_complaint";

	protected $fillable = [
		'property_id', 'is_feedback', 'is_complaint', 'is_agent_not_reachable', 'feedback', 'complaint_type', 'agent_not_reachable_type', 'status'
	];

	public function Property(){
		return $this->hasOne('App\Properties','id','property_id');
	}

}
