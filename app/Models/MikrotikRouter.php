<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MikrotikRouter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'ip_address',
        'port',
        'username',
        'password',
        'location',
        'description',
        'is_active',
        'last_connected_at',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_connected_at' => 'datetime',
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pppoeUsers()
    {
        return $this->hasMany(PppoeUser::class);
    }
}