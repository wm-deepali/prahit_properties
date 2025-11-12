<?php

namespace App;

use App\Properties;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'role',
        'firstname',
        'lastname',
        'gender',
        'address',
        'email',
        'mobile_number',
        'state_id',
        'city_id',
        'avatar',
        'auth_token',
        'password',
        'otp',
        'status',
        'company_name',
        'mobile_verified',
        'is_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['full_name'];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        return trim("{$this->firstname} {$this->lastname}");
    }
    public function StateCity()
    {
        return $this->hasOne('App\Cities', 'id', 'city_id');
    }

    public static function findIdentityByAccessToken($token)
    {
        return self::where('auth_token', $token)->first();
    }

    public function getProperties()
    {
        return $this->hasMany(Properties::class, 'user_id', 'id');
    }

    public function getPremiumProperties($id)
    {
        return Properties::where('user_id', $id)->where('listing_type', 'Paid')->get();
    }

    public function getFreeProperties($id)
    {
        return Properties::where('user_id', $id)->where('listing_type', 'Free')->get();
    }

    public function getState()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getCity()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function activeSubscription()
    {
        return $this->hasOne(\App\Models\Subscription::class, 'user_id')->where('is_active', 1)->latest();
    }

    public function profileSection()
    {
        return $this->hasOne(\App\Models\ProfileSection::class, 'user_id');
    }

    public function businessListing()
    {
        return $this->hasOne(\App\BusinessListing::class, 'user_id');
    }

}
