<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\BusinessListing;

class BusinessWishlist extends Model
{
    protected $fillable = [
        'user_id',
        'business_listing_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(BusinessListing::class, 'business_listing_id');
    }
}
