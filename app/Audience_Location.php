<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audience_Location extends Model {

	protected $table = "audience_location";

	protected $fillable = [
		'audience_id', 'location_id'
	];
}
