<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logo',
        'business_name',
        'rera_number',
        'operating_since',
        'years_experience',
        'deals_in',
        'description',
        'services',
        'address',
        'phone',
        'email',
        'working_hours',
    ];

    protected $casts = [
        'services' => 'array',
        'working_hours' => 'array', // since it's stored as JSON
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
