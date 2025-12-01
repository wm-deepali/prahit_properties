<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimListing extends Model {

    protected $fillable = [
        'property_id', 'user_id', 'approval_status', 'otp', 'otp_verify'
    ];

    protected $table = "claim_listing";

    // 🔥 Relationship: each claim belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
