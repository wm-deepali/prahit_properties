<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PropertyTypes extends Model {

	protected $fillable = ['type','status'];

    protected static function boot() {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', "0");
        });
    }	

}
