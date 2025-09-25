<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailIntegration extends Model {

	protected $fillable = ['provider','api_url','api_key'];

}
