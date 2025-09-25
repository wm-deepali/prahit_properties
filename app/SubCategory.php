<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
	protected $fillable = [
		'category_id', 'sub_category_name', 'sub_category_slug', 'sub_category_meta_title', 'sub_category_meta_description', 'sub_category_keywords'

	];

	protected $table = "sub_categories";

	public function Subsubcategory() {
		return $this->hasMany('App\SubSubCategory', 'sub_category_id', 'id');
	}

	public function Category() {
		return $this->belongsTo('App\Category', 'category_id', 'id');
	}

}
