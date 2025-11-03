<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable = [
        // Common fields
        'package_type',
        'name',
        'price',
        'validity',
        'description',
        'is_active',

        // ===== PROPERTY PACKAGE FIELDS =====
        'number_of_listing',
        'photos_per_listing',
        'video_upload',
        'response_rate',
        'property_visibility',
        'verified_tag',
        'premium_seller',
        'profile_page',
        'profile_visibility',
        'profile_in_search_result',
        'priority_in_search',
        'customer_support',
        'lead_alerts',

        // ===== SERVICE PROVIDER PACKAGE FIELDS =====
        'business_listing',
        'total_services',
        'profile_page_with_contact',
        'business_logo_banner',
        'appear_in_local_search',
        'verified_badge',
        'premium_badge',
        'image_upload_limit',
        'video_upload_service',
        'lead_enquiries',
        'response_rate_service',
        'featured_in_top_provider',
        'customer_support_service',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'number_of_listing' => 'integer',
        'photos_per_listing' => 'integer',
        'total_services' => 'integer',
        'image_upload_limit' => 'integer',
    ];

    /**
     * Scope for active packages.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get a short version of the package name.
     */
    public function getShortNameAttribute()
    {
        return strlen($this->name) > 20
            ? substr($this->name, 0, 20) . '...'
            : $this->name;
    }
}
