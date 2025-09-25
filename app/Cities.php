<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $fillable = [
    	'state_id',
    	'name',
    	'location'
    ];
}
