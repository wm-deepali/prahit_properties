<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'end_date',
        'amount',
        'payment_status',
        'transaction_id',
        'is_active',
        'used_listings',
        'used_services'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'subscription_id');
    }

}

