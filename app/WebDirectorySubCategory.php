<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebDirectorySubCategory extends Model {

	protected $fillable = [
		'category_id',
		'sub_category_name',
		'sub_category_slug',
		'property_category_id',
		'sub_category_id',
		'sub_sub_category_id',
		'status'
	];

	public function WebDirectoryCategory() {
		return $this->belongsTo(WebDirectoryCategory::class, 'category_id', 'id');
	}

	public function getPropertyCategory() {
		return $this->belongsTo(Category::class, 'property_category_id', 'id');
	}

	public function getPropertySubCategory() {
		return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
	}

	public function getPropertySubSubCategory() {
		return $this->belongsTo(SubSubCategory::class, 'sub_sub_category_id', 'id');
	}

}
