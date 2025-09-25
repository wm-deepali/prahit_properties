<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLocations extends Model
{
	protected $fillable = [
		'location_id', 'sub_location_name'
	];
}
