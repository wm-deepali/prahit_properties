<?php

namespace App;

use App\Properties;
use Illuminate\Database\Eloquent\Model;

class PopularCity extends Model
{
    protected $fillable = [
    	'slug',
    	'state_id',
    	'city_id',
    	'image',
    	'heading'
    ];

    public function getState() {
    	return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getCity() {
    	return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getPropertyCount($city_id)
    {
    	$data = Properties::where('city_id', $city_id)->count();
    	return $data;
    }

}
