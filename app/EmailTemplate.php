<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{

    protected $fillable = [
    	'title',
    	'subject',
    	'template',
    	'image',
    	'status'
    ];
}
