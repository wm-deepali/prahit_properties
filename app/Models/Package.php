<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'business_listing',
        'profile_page_with_contact',
        'business_logo_banner',
        'service_limit',
        'duration',
        'duration_unit',
        'image_upload_limit',
        'video_upload',
        'appear_in_search',
        'verified_badge',
        'premium_badge',
        'lead_enquiries',
        'response_rate',
        'featured_in_top',
        'customer_support',
        'lead_alerts',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'business_listing' => 'boolean',
        'profile_page_with_contact' => 'boolean',
        'business_logo_banner' => 'boolean',
        'video_upload' => 'boolean',
        'verified_badge' => 'boolean',
        'premium_badge' => 'boolean',
        'featured_in_top' => 'boolean',
        'lead_alerts' => 'boolean',
        'is_active' => 'boolean',
    ];
}
