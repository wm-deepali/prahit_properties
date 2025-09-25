<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebDirectoryCategory extends Model {

	protected $fillable = [
		'category_name', 'category_slug', 'category_meta_title', 'category_meta_description', 'category_keywords', 'status'
	];

}
