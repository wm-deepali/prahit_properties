<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'category_name', 'category_slug', 'category_meta_title', 'category_meta_description', 'category_keywords', 'status'
	];

	protected $table = "categories";

	public function Subcategory() {
		return $this->hasMany('App\SubCategory', 'category_id', 'id');
	}
}
