<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'pppoe_user_id',
        'amount',
        'billing_period_start',
        'billing_period_end',
        'due_date',
        'paid_at',
        'payment_method',
        'transaction_id',
        'status',
        'notes',
    ];

    protected $casts = [
        'billing_period_start' => 'date',
        'billing_period_end' => 'date',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the PPPoE user that owns this billing record
     */
    public function pppoeUser()
    {
        return $this->belongsTo(PppoeUser::class);
    }
}