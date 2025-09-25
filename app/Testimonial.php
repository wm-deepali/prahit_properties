<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
    	'name',
    	'email',
    	'mobile_number',
    	'image',
    	'designation',
    	'description',
    	'status',
    	'show_on_front'
    ];
}
