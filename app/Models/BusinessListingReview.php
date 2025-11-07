<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListingReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_listing_id',
        'user_id',
        'name',
        'email',
        'phone',
        'rating',
        'comment',
    ];

    public function businessListing()
    {
        return $this->belongsTo(\App\BusinessListing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
