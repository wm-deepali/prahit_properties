<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
    	'name',
    	'meta_title',
    	'meta_description',
    	'meta_keywords',
    	'status'
    ];

    public function getRelatedBlogs() {
    	return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}
