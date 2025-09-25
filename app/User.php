<?php

namespace App;

use App\Properties;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role','firstname', 'lastname', 'gender', 'address', 'email', 'mobile_number', 'state_id','city_id','avatar','auth_token','password','otp', 'status', 'company_name', 'mobile_verified', 'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function StateCity() {
        return $this->hasOne('App\Cities', 'id', 'city_id');
    }

    public static function findIdentityByAccessToken($token) {
        return self::where('auth_token', $token)->first();
    }

    public function getProperties() {
        return $this->hasMany(Properties::class, 'user_id', 'id');
    }

    public function getPremiumProperties($id) {
        $properties = Properties::where('user_id', $id)->where('listing_type', 'Paid')->get();
        return $properties;
    }

    public function getFreeProperties($id) {
        $properties = Properties::where('user_id', $id)->where('listing_type', 'Free')->get();
        return $properties;
    }

    public function getState() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getCity() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
