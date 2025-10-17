<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'category_id',
        'heading',
        'image',
        'image_alt',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'featured',
        'status'
    ];

    public function getBlogCategory() {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
}
