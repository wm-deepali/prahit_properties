<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Complaint extends Model
{
    use Notifiable;
    
    protected $fillable = [
    	'name',
    	'email',
    	'mobile_number',
    	'link',
    	'reasons',
    	'other',
    	'other_reason',
    	'message',
    	'file',
    	'status',
        'reply'
    ];
}
