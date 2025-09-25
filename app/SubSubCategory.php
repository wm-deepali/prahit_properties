<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
	protected $fillable = [
		'category_id', 'sub_category_id', 'sub_sub_category_name', 'sub_sub_category_slug', 'sub_sub_category_meta_title', 'sub_sub_category_meta_description', 'sub_sub_category_keywords'
	];

	protected $table = "sub_sub_categories";

	public function Subcategory() {
		return $this->belongsTo('App\SubCategory', 'sub_category_id', 'id');
	}
}
