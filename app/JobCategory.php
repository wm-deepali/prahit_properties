<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = [
    	'name',
    	'meta_title',
    	'meta_description',
    	'meta_keywords',
    	'status'
    ];

    public function getRealatedJobs()
    {
    	return $this->hasMany(Job::class, 'category_id', 'id');
    }
}
