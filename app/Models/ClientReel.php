<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReel extends Model
{
    use HasFactory;

    protected $fillable = [
        'reel_type',
        'youtube_url',
        'facebook_url',
        'video_file',
        'author_name',
        'author_image',
        'designation',
    ];
}
