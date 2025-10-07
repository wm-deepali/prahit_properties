<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategory;
use App\Category;
use App\SubSubCategory;

class Form extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'sub_category_id',
        'sub_sub_category_id', // added
        'form_data',
        'status'
    ];

    // Get category names from comma-separated IDs
    public function getCategories($ids) {
        $cat_ids = explode(',', $ids);
        $picked = Category::whereIn('id', $cat_ids)->get();
        if ($picked) {
            $cat_names = $picked->pluck('category_name')->toArray();
            return implode(', ', $cat_names);
        } else {
            return 'N/A';
        }
    }

    // Get subcategory names from comma-separated IDs
    public function getSubCategories($ids) {
        $cat_ids = explode(',', $ids);
        $picked = SubCategory::whereIn('id', $cat_ids)->get();
        if ($picked) {
            $cat_names = $picked->pluck('sub_category_name')->toArray();
            return implode(', ', $cat_names);
        } else {
            return 'N/A';
        }
    }

    // Get sub-subcategory names from comma-separated IDs
    public function getSubSubCategories($ids) {
		// dd($ids);
        $cat_ids = explode(',', $ids);
        $picked = SubSubCategory::whereIn('id', $cat_ids)->get();
        if ($picked) {
            $cat_names = $picked->pluck('sub_sub_category_name')->toArray();
            return implode(', ', $cat_names);
        } else {
            return 'N/A';
        }
    }
}
