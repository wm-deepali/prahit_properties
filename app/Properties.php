<?php

namespace App;

use App\Locations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Properties extends Model
{
    protected $table = 'properties';

    protected $fillable = [
        'id',
        'user_id',
        'visitor_id',
        'formtype_id',
        'listing_id',
        'title',
        'slug',
        'type_id',
        'price',
        'price_label',
        'price_label_second',
        'description',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'address',
        'state_id',
        'city_id',
        'location_id',
        'sub_location_id',
        'sub_location_name',
        'featured_image',
        'gallery_images',
        'status',
        'additional_info',
        'approval',
        'publish_status',
        'listing_type',
        'amenities',
        'construction_age',
        'published_date',
        'property_map_link',
        'reason',
        'trending',
        'featured',
        'verified',
        'property_status',
        'property_status_second',
        'registration_status',
        'registration_status_second',
        'furnishing_status',
        'furnishing_status_second',
        'latitude',
        'longitude',
    ];

    // protected static function boot() {
    //     parent::boot();
    //     static::addGlobalScope('status', function (Builder $builder) {
    //         $builder->where('status', '=', '1');
    //     });
    // }

    public function Category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function SubCategory()
    {
        return $this->hasOne('App\SubCategory', 'id', 'sub_category_id');
    }

    public function SubSubCategory()
    {
        return $this->hasOne('App\SubSubCategory', 'id', 'sub_sub_category_id');
    }

    public function Location()
    {
        return $this->hasOne('App\Locations', 'id', 'location_id');
    }

    public function FormTypes()
    {
        return $this->belongsTo('App\FormTypes', 'formtype_id', 'id');
    }

    public function PropertyTypes()
    {
        return $this->belongsTo('App\PropertyTypes', 'type_id', 'id');
    }

    public function PropertyFeatures()
    {
        return $this->hasMany('App\PropertiesFields', 'property_id', 'id');
    }

    public function PropertyGallery()
    {
        return $this->hasMany(PropertyGallery::class, 'property_id', 'id');
    }

    public function getState()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getCity()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getLocations($location_ids)
    {
        $locations = Locations::whereIn('id', explode(',', $location_ids))->get();
        $data = [];
        foreach ($locations as $value) {
            $data[] = $value->location;
        }
        return implode(', ', $data);
    }

    public function getSubLocations($sublocation_ids)
    {
        $locations = SubLocations::whereIn('id', explode(',', $sublocation_ids))->get();
        $data = [];
        foreach ($locations as $value) {
            $data[] = $value->sub_location_name;
        }
        return implode(', ', $data);
    }


    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getAmenities($ids)
    {
        return Amenity::whereIn('id', explode(',', $ids))->get();
    }


    public function getPriceLabels($ids)
    {
        $ids = explode(',', $ids);
        return \App\Models\PriceLabel::whereIn('id', $ids)->pluck('name')->implode(', ');
    }

    public function getPriceLabelObj()
    {
        return \App\Models\PriceLabel::find($this->price_label);
    }

    public function getPropertyStatuses($ids)
    {
        $ids = explode(',', $ids);
        return \App\Models\PropertyStatus::whereIn('id', $ids)->pluck('name')->implode(', ');
    }

    public function getPropertyStatusObj()
    {
        return \App\Models\PropertyStatus::find($this->property_status);
    }

    public function getRegistrationStatuses($ids)
    {
        $ids = explode(',', $ids);
        return \App\Models\RegistrationStatus::whereIn('id', $ids)->pluck('name')->implode(', ');
    }

    public function getRegistrationStatusObj()
    {
        return \App\Models\RegistrationStatus::find($this->registration_status);
    }

    public function getFurnishingStatuses($ids)
    {
        $ids = explode(',', $ids);
        return \App\Models\FurnishingStatus::whereIn('id', $ids)->pluck('name')->implode(', ');
    }

    public function getFurnishingStatusObj()
    {
        return \App\Models\FurnishingStatus::find($this->furnishing_status);
    }

    public function getCategoryHierarchyName()
    {
        if ($this->SubSubCategory && !empty($this->SubSubCategory->sub_sub_category_name)) {
            return $this->SubSubCategory->sub_sub_category_name;
        }

        if ($this->SubCategory && !empty($this->SubCategory->sub_category_name)) {
            return $this->SubCategory->sub_category_name;
        }

        if ($this->Category && !empty($this->Category->category_name)) {
            return $this->Category->category_name;
        }

        return null;
    }

}
