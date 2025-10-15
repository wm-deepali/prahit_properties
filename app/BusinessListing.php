<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_type',
        'verified_status',
        'category_id',
        'business_name',
        'email',
        'mobile_number',
        'whatsapp_number',
        'website',
        'established_year',
        'introduction',
        'detail',
        'full_address',
        'state',
        'city',
        'pin_code',
        'logo',
        'banner_image',
        'total_views',
        'total_enquiries',
        'status',
    ];

    // 🔹 Relationship: Category
    public function category()
    {
        return $this->belongsTo(WebDirectoryCategory::class, 'category_id');
    }

    // 🔹 Relationship: Subcategories (Many-to-Many)
    public function subCategories()
    {
        return $this->belongsToMany(WebDirectorySubCategory::class, 'business_listing_sub_category');
    }

    // 🔹 Relationship: Services
    public function services()
    {
        return $this->hasMany(BusinessService::class, 'business_listing_id');
    }
}
