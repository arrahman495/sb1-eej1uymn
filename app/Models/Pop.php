<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'code',
        'location',
        'address',
        'contact_person',
        'contact_phone',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sdtZones()
    {
        return $this->hasMany(SdtZone::class);
    }

    public function pppoeUsers()
    {
        return $this->hasMany(PppoeUser::class);
    }
}