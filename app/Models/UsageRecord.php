<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsageRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'pppoe_user_id',
        'date',
        'bytes_in',
        'bytes_out',
        'packets_in',
        'packets_out',
        'session_time',
        'avg_speed_in',
        'avg_speed_out',
    ];

    protected $casts = [
        'date' => 'date',
        'bytes_in' => 'integer',
        'bytes_out' => 'integer',
        'packets_in' => 'integer',
        'packets_out' => 'integer',
        'session_time' => 'integer',
        'avg_speed_in' => 'decimal:2',
        'avg_speed_out' => 'decimal:2',
    ];

    /**
     * Get the PPPoE user that owns this usage record
     */
    public function pppoeUser()
    {
        return $this->belongsTo(PppoeUser::class);
    }

    /**
     * Get total data usage
     */
    public function getTotalUsageAttribute(): int
    {
        return $this->bytes_in + $this->bytes_out;
    }
}