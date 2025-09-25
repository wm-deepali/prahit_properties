<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model {

	protected $fillable = ['property_id','image_path'];

	protected $table = "property_gallery";

}
