<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IspDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain_name',
        'txt_record_value',
        'is_verified',
        'verified_at',
        'is_active',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}