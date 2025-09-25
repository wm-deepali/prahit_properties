<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentEnquiry extends Model {

	protected $fillable = [
		'property_id', 'name', 'email', 'mobile_number', 'interested_in'
	];

	protected $table = "agent_enquiry";

	public function Property(){
		return $this->hasOne('App\Properties', 'id', 'property_id');
	}

	public function Interested() {
		return $this->hasOne('App\InterestedType', 'id', 'interested_in');
	}

}
