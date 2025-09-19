<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MikrotikRouter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ip_address',
        'port',
        'username',
        'password',
        'api_port',
        'is_active',
        'last_connected_at',
        'connection_status',
        'version',
        'model',
        'isp_owner_id',
        'location',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_connected_at' => 'datetime',
        'port' => 'integer',
        'api_port' => 'integer',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the ISP owner that owns this router
     */
    public function ispOwner()
    {
        return $this->belongsTo(User::class, 'isp_owner_id');
    }

    /**
     * Get PPPoE users associated with this router
     */
    public function pppoeUsers()
    {
        return $this->hasMany(PppoeUser::class, 'mikrotik_router_id');
    }

    /**
     * Get POP zones associated with this router
     */
    public function popZones()
    {
        return $this->hasMany(PopZone::class, 'mikrotik_router_id');
    }
}