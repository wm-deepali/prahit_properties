<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_listing_id',
        'title',
        'link',
        'image',
    ];

    /**
     * Relationship: Belongs to BusinessListing
     */
    public function businessListing()
    {
        return $this->belongsTo(\App\BusinessListing::class, 'business_listing_id');
    }
}
