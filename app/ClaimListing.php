<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimListing extends Model {

	protected $fillable = [
		'property_id', 'user_id', 'approval_status', 'otp', 'otp_verify'
	];

	protected $table = "claim_listing";

}
