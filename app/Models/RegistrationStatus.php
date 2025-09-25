<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationStatus extends Model
{
    use HasFactory;

    protected $table = 'registration_statuses';

    protected $fillable = [
        'name',
        'input_format',
        'second_input',
        'second_input_label',
        'status',
    ];
}
