<?php

namespace App;

use App\Locations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Properties extends Model {

	protected $table = 'properties';
	
	protected $fillable = [
		'id','user_id','visitor_id','formtype_id', 'listing_id', 'title', 'slug', 'type_id', 'price', 'price_label', 'description', 'category_id', 'sub_category_id', 'sub_sub_category_id', 'address', 'state_id', 'city_id', 'location_id', 'sub_location_id', 'featured_image', 'gallery_images', 'status', 'additional_info', 'approval','publish_status', 'listing_type', 'amenities', 'construction_age','published_date', 'property_map_link', 'reason', 'trending','featured'
	];

    // protected static function boot() {
    //     parent::boot();

    //     static::addGlobalScope('status', function (Builder $builder) {
    //         $builder->where('status', '=', '1');
    //     });
    // }

	public function Category() {
		return $this->hasOne('App\Category', 'id', 'category_id');
	}

	public function SubCategory() {
		return $this->hasOne('App\SubCategory', 'id', 'sub_category_id');
	}

	public function Location() {
		return $this->hasOne('App\Locations', 'id', 'location_id');
	}

	public function FormTypes() {
		return $this->belongsTo('App\FormTypes','formtype_id','id');
	}

	public function PropertyTypes() {
		return $this->belongsTo('App\PropertyTypes', 'type_id', 'id');
	}

	public function PropertyFeatures() {
		return $this->hasMany('App\PropertiesFields', 'property_id', 'id');
	}

	public function PropertyGallery() {
		return $this->hasMany(PropertyGallery::class, 'property_id', 'id');
	}

	public function getState() {
		return $this->belongsTo(State::class, 'state_id', 'id');
	}

	public function getCity() {
		return $this->belongsTo(City::class, 'city_id', 'id');
	}

	public function getLocations($location_ids) {
		$locations = Locations::whereIn('id', explode(',', $location_ids))->get();
		$data = [];
		if(count($locations) > 0) {
			foreach ($locations as $key => $value) {
				array_push($data, $value->location);
			}
			return implode(', ', $data);
		}else {
			return '';
		}
	}

	public function getSubLocations($sublocation_ids) {
		$locations = SubLocations::whereIn('id', explode(',', $sublocation_ids))->get();
		$data = [];
		if(count($locations) > 0) {
			foreach ($locations as $key => $value) {
				array_push($data, $value->sub_location_name);
			}
			return implode(', ', $data);
		}else {
			return '';
		}
	}

	public function getUser() {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function getAmenities($ids) {
		$features = Amenity::whereIn('id', explode(',', $ids))->get();
		return $features;
	}
}
