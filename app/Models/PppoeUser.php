<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PppoeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'profile',
        'service',
        'local_address',
        'remote_address',
        'status',
        'last_logged_out',
        'uptime',
        'bytes_in',
        'bytes_out',
        'packets_in',
        'packets_out',
        'mikrotik_router_id',
        'isp_owner_id',
        'reseller_id',
        'sub_reseller_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'billing_cycle',
        'monthly_fee',
        'installation_date',
        'expiry_date',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_logged_out' => 'datetime',
        'installation_date' => 'date',
        'expiry_date' => 'date',
        'bytes_in' => 'integer',
        'bytes_out' => 'integer',
        'packets_in' => 'integer',
        'packets_out' => 'integer',
        'monthly_fee' => 'decimal:2',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the MikroTik router that this user belongs to
     */
    public function mikrotikRouter()
    {
        return $this->belongsTo(MikrotikRouter::class);
    }

    /**
     * Get the ISP owner that owns this user
     */
    public function ispOwner()
    {
        return $this->belongsTo(User::class, 'isp_owner_id');
    }

    /**
     * Get the reseller that manages this user
     */
    public function reseller()
    {
        return $this->belongsTo(User::class, 'reseller_id');
    }

    /**
     * Get the sub reseller that manages this user
     */
    public function subReseller()
    {
        return $this->belongsTo(User::class, 'sub_reseller_id');
    }

    /**
     * Get billing records for this user
     */
    public function billingRecords()
    {
        return $this->hasMany(BillingRecord::class);
    }

    /**
     * Get usage records for this user
     */
    public function usageRecords()
    {
        return $this->hasMany(UsageRecord::class);
    }

    /**
     * Check if user is currently active
     */
    public function isOnline(): bool
    {
        return $this->status === 'R'; // R = Running in MikroTik
    }

    /**
     * Get total data usage
     */
    public function getTotalUsageAttribute(): int
    {
        return $this->bytes_in + $this->bytes_out;
    }
}