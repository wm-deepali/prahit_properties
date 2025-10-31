<?php

namespace App\Models;

use App\BusinessListing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
        'email',
        'mobile',
        'message',
    ];

    // Relationship: each enquiry belongs to one business listing
    public function business()
    {
        return $this->belongsTo(BusinessListing::class, 'business_id');
    }
}
