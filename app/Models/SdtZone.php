<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SdtZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'pop_id',
        'user_id',
        'name',
        'code',
        'description',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    public function pop()
    {
        return $this->belongsTo(Pop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pppoeUsers()
    {
        return $this->hasMany(PppoeUser::class);
    }
}