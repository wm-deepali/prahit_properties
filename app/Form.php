<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;
use App\Category;

class Form extends Model
{
    protected $fillable = [
    	'name',
    	'category_id',
    	'sub_category_id',
    	'form_data',
    	'status'
    ];

    public function getCategories($ids) {
    	$cat_ids = explode(',', $ids);
    	$picked = Category::whereIn('id', $cat_ids)->get();
    	if($picked) {
    		$cat_names = [];
    		foreach ($picked as $value) {
    			array_push($cat_names, $value->category_name);
    		}
    		return implode(', ', $cat_names);
    	}else {
    		return 'N/A';
    	}
    }

    public function getSubCategories($ids) {
    	$cat_ids = explode(',', $ids);
    	$picked  = SubCategory::whereIn('id', $cat_ids)->get();
    	if($picked) {
    		$cat_names = [];
    		foreach ($picked as $value) {
    			array_push($cat_names, $value->sub_category_name);
    		}
    		return implode(', ', $cat_names);
    	}else {
    		return 'N/A';
    	}
    }
}
