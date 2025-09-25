<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model {

	protected $table = "payment_gateway";

	protected $fillable = ['merchant','mode','auth_header','merchant_key','merchant_salt'];
}
