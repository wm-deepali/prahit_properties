<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
	protected $fillable = [
		'state_id', 'city_id', 'location', 'status'
	];

	public function getState() {
		return $this->belongsTo(State::class, 'state_id', 'id');
	}

	public function Cities() {
		return $this->hasOne('App\Cities', 'id', 'city_id');
	}

	public function SubLocations() {
		return $this->hasMany('App\SubLocations', 'location_id', 'id');
	}
}
