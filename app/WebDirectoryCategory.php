<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebDirectoryCategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_slug',
        'category_meta_title',
        'category_meta_description',
        'category_keywords',
        'status'
    ];

    // 🔹 Relationship: One Category → Many Subcategories
    public function subcategories()
    {
        return $this->hasMany(WebDirectorySubCategory::class, 'category_id', 'id');
    }
}
