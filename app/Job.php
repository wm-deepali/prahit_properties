<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
    	'category_id',
    	'heading',
    	'tag_line',
    	'skills',
    	'requirements',
    	'description',
    	'country',
    	'state',
    	'city',
    	'status'
    ];

    public function getJobCategory() {
        return $this->belongsTo(JobCategory::class, 'category_id', 'id');
    }

    public function getCountry() {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function getSkills($ids) {
        $datas = Technology::whereIn('id', explode(',', $ids))->get();
        $skills = [];
        if(count($datas) > 0) {
            foreach ($datas as $key => $value) {
                array_push($skills, $value->name);
            }
            return implode(', ', $skills);
        }else {
            return '';
        }
    }
}
