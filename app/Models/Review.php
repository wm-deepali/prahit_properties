<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_section_id',
        'user_id',
        'name',
        'email',
        'phone',
        'rating',
        'comment',
    ];

    /**
     * Relationship: Review belongs to a ProfileSection
     */
    public function profileSection()
    {
        return $this->belongsTo(ProfileSection::class);
    }

    /**
     * Relationship: Review may belong to a User (optional)
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
