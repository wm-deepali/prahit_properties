<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
    	'heading',
    	'image',
    	'description',
    	'status'
    ];
}
