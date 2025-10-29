<?php

namespace App\Models;
use App\Properties;
use Illuminate\Database\Eloquent\Model;

class PropertyView extends Model
{
    protected $fillable = ['property_id', 'user_id', 'ip_address'];

    public function Property()
    {
        return $this->belongsTo(Properties::class, 'property_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
