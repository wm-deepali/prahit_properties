<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
	protected $fillable = [
		'job_id',
		'name',
		'email',
		'mobile_number',
		'resume'
	];

	public function job()
	{
		return $this->belongsTo(Job::class, 'job_id');
	}

}
