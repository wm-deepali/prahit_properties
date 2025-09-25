<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnishingStatus extends Model
{
    use HasFactory;

    protected $table = 'furnishing_statuses';

    protected $fillable = [
        'name',
        'input_format',
        'second_input',
        'second_input_label',
        'status',
    ];
}
