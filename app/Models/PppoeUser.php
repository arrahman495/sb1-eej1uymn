<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PppoeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pop_id',
        'sdt_zone_id',
        'mikrotik_router_id',
        'username',
        'password',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'service_type',
        'profile_name',
        'ip_address',
        'is_active',
        'is_online',
        'last_login_at',
        'last_logout_at',
        'bytes_in',
        'bytes_out',
        'mikrotik_data',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_online' => 'boolean',
        'last_login_at' => 'datetime',
        'last_logout_at' => 'datetime',
        'mikrotik_data' => 'array',
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pop()
    {
        return $this->belongsTo(Pop::class);
    }

    public function sdtZone()
    {
        return $this->belongsTo(SdtZone::class);
    }

    public function mikrotikRouter()
    {
        return $this->belongsTo(MikrotikRouter::class);
    }
}