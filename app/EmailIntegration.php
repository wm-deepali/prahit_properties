<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailIntegration extends Model {

	protected $table = "email_integration";
	protected $fillable = [
		'driver',
		'host',
		'port',
		'user_name',
		'password',
		'encryption',
		'form_address',
		'form_name'
	];

}
