<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model {
	// protected $fillable = [
	// 	'owner_type', 'firstname', 'lastname', 'email', 'mobile_number', 'state_id', 'city_id'
	// ];

	protected $fillable = [
		'mobile_number', 'otp'
	];

	protected $table = "visitor";
}
