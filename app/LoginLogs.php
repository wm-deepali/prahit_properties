<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLogs extends Model
{
    protected $fillable = [
        'user_id', 'ip_address'
    ];

    protected $table = "login_logs";
}
