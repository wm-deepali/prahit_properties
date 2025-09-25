<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsConfig extends Model
{
	protected $fillable = [
		'user_id', 'sender_id', 'hash_key', 'route', 'country_code'
	];

	protected $table = "sms_api_config";
}
