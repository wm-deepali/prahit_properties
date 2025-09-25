<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SupportCenter extends Model
{
	use Notifiable;
	
    protected $fillable = [
    	'name',
    	'email',
    	'mobile_number',
    	'subject',
    	'message',
    	'reply',
    ];
}
