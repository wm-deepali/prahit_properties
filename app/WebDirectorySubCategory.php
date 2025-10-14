<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebDirectorySubCategory extends Model
{

	protected $fillable = [
		'category_id',
		'sub_category_name',
		'sub_category_slug',
		'property_category_id',
		'sub_category_id',
		'sub_sub_category_id',
		'status'
	];

	public function WebDirectoryCategory()
	{
		return $this->belongsTo(WebDirectoryCategory::class, 'category_id', 'id');
	}

	public function getPropertyCategory()
	{
		return $this->belongsTo(Category::class, 'property_category_id', 'id');
	}

	public function getPropertySubCategory()
	{
		return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
	}


	// 🔹 Automatically convert "1,2,3" → ['1', '2', '3'] when reading
	public function getSubSubCategoryIdAttribute($value)
	{
		return $value ? explode(',', $value) : [];
	}

	// 🔹 Automatically convert ['1','2','3'] → "1,2,3" when saving
	public function setSubSubCategoryIdAttribute($value)
	{
		if (is_array($value)) {
			$this->attributes['sub_sub_category_id'] = implode(',', $value);
		} else {
			$this->attributes['sub_sub_category_id'] = $value;
		}
	}


}
