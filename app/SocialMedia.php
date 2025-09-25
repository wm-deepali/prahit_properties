<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = [
    	'facebook',
    	'twitter',
    	'insta',
    	'youtube'
    ];
}
