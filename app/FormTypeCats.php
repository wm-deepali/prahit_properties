<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormTypeCats extends Model
{
	protected $fillable = [
		'form_type_id',
		'category_id',
		'sub_category_id',
		'sub_sub_category_id'
	];

	protected $table = 'form_types_cats';

	public $timestamps = false;

	// Relation to main Category
	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	// Relation to SubCategory
	public function subCategory()
	{
		return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
	}

	// Relation to SubSubCategory
	public function subSubCategory()
	{
		return $this->belongsTo(SubSubCategory::class, 'sub_sub_category_id', 'id');
	}

	// Relation to FormType
	public function formType()
	{
		return $this->belongsTo(FormTypes::class, 'form_type_id', 'id');
	}
}
