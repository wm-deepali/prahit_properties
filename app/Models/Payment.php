<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'subscription_id',
        'payment_method',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'payment_response',
    ];

    protected $casts = [
        'payment_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

}
