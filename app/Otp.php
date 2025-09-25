<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model {

	protected $fillable = [
		'otp', 'user_id','visitor_id'
	];

	protected $table = "otp";
}
