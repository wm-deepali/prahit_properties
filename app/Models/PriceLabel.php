<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'input_format',
        'second_input',
        'second_input_label',
        'status'
    ];

}
