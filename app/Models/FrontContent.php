<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'heading',
        'title',
        'description',
        'ids',
        'image',
    ];
}
