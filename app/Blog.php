<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
    	'category_id',
    	'heading',
    	'image',
    	'description',
    	'featured',
    	'status'
    ];

    public function getBlogCategory() {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }
}
