<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterContent extends Model
{
    protected $fillable = [
    	'slug',
    	'heading',
    	'title',
    	'description',
    	'key_one',
    	'key_two',
    	'key_three',
    	'image'
    ];
}
