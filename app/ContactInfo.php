<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
    	'icon',
    	'title',
    	'address',
    	'email',
    	'mobile_number'
    ];
}
