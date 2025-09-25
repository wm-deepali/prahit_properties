<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpContent extends Model
{
    protected $fillable = [
    	'heading',
    	'content_one',
    	'content_two',
    	'content_three'
    ];
}
