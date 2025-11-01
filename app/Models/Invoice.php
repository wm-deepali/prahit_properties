<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'payment_id',
        'invoice_number',
        'invoice_date',
        'amount',
        'currency',
        'tax_amount',
        'total_amount',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_address',
        'status',
        'invoice_file',
    ];

    protected $casts = [
        'invoice_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
