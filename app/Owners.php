<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owners extends Model
{
	protected $fillable = [
		'user_id', 'type', 'location', 'gender', 'status'
	];

	public function User() {
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
}
