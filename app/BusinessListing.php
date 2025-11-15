<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_type',
        'verified_status',
        'category_id',
        'slug',
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
        // 'rating',
        // 'rating_count',
        'status',
        'is_published',
        'registration_number',
        'deals_in',
        'satisfied_clients',
    ];

    protected $appends = [
        'average_rating',
        'rating_count',
        'rating_stars',
        'verified_badge',
        'premium_badge'
    ];


    public function getVerifiedBadgeAttribute()
    {
        // If the user exists and role is admin → always yes
        if ($this->user && $this->user->role === 'admin') {
            return 'Yes';
        }

        // If user has active subscription and package has verified_tag
        if (
            $this->user &&
            $this->user->activeSubscription &&
            $this->user->activeSubscription->package
        ) {

            return $this->user->activeSubscription->package->verified_badge ?? 'no';
        }

        // Default
        return 'no';
    }

     public function getPremiumBadgeAttribute()
    {
        // If the user exists and role is admin → always yes
        if ($this->user && $this->user->role === 'admin') {
            return "Yes";
        }

        // If user has active subscription and package has verified_tag
        if (
            $this->user &&
            $this->user->activeSubscription &&
            $this->user->activeSubscription->package
        ) {

            return $this->user->activeSubscription->package->premium_badge ?? 'no';
        }

        // Default
        return 'no';
    }

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

    // 🔹 Relationship: Property Categories
    public function propertyCategories()
    {
        return $this->belongsToMany(Category::class, 'business_property_categories');
    }

    // 🔹 Relationship: Property SubCategories
    public function propertySubCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'business_property_subcategories');
    }

    // 🔹 Relationship: Property Sub-SubCategories
    public function propertySubSubCategories()
    {
        return $this->belongsToMany(SubSubCategory::class, 'business_property_sub_subcategories');
    }

    // 🔹 Relationship: User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // 🔹 Relationship: Portfolio
    public function portfolio()
    {
        return $this->hasMany(\App\Models\BusinessPortfolio::class, 'business_listing_id');
    }

    // 🔹 Relationship: Working Hours
    public function workingHours()
    {
        return $this->hasMany(\App\Models\BusinessWorkingHour::class, 'business_listing_id');
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\BusinessListingReview::class, 'business_listing_id');
    }

    public function getAverageRatingAttribute()
    {
        return number_format($this->reviews()->avg('rating') ?? 0, 1);
    }


    public function getRatingCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getRatingStarsAttribute()
    {
        $rating = $this->reviews()->avg('rating') ?? 0;

        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

        $html = '';
        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<i class="fas fa-star text-warning"></i>';
        }
        if ($halfStar) {
            $html .= '<i class="fas fa-star-half-alt text-warning"></i>';
        }
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<i class="far fa-star text-warning"></i>';
        }

        return $html;
    }

}
