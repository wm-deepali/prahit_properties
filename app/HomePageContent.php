<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    protected $fillable = [
    	'slug',
    	'heading',
    	'heading_more',
    	'sub_description',
    	'description',
    	'images'
    ];
}
