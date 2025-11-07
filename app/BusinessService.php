<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessService extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_listing_id',
        'name',
        'description',  // added description
        'price',        // added price
        'image',
    ];

    // 🔹 Relationship: Belongs to Business Listing
    public function business()
    {
        return $this->belongsTo(BusinessListing::class, 'business_listing_id');
    }
}
