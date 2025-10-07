<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'state_id',
        'name',
        'location'
    ];

    /**
     * Define the relationship: a City belongs to a State
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
