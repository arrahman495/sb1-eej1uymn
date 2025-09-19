<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'mikrotik_router_id',
        'isp_owner_id',
        'reseller_id',
        'sub_reseller_id',
        'is_active',
        'coordinates',
        'coverage_area',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'coordinates' => 'array',
        'coverage_area' => 'array',
    ];

    /**
     * Get the MikroTik router associated with this POP zone
     */
    public function mikrotikRouter()
    {
        return $this->belongsTo(MikrotikRouter::class);
    }

    /**
     * Get the ISP owner that owns this POP zone
     */
    public function ispOwner()
    {
        return $this->belongsTo(User::class, 'isp_owner_id');
    }

    /**
     * Get the reseller that manages this POP zone
     */
    public function reseller()
    {
        return $this->belongsTo(User::class, 'reseller_id');
    }

    /**
     * Get the sub reseller that manages this POP zone
     */
    public function subReseller()
    {
        return $this->belongsTo(User::class, 'sub_reseller_id');
    }

    /**
     * Get PPPoE users in this POP zone
     */
    public function pppoeUsers()
    {
        return $this->hasMany(PppoeUser::class);
    }
}