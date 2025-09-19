<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'version',
        'author',
        'file_path',
        'is_active',
        'is_installed',
        'config',
        'permissions',
        'installed_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_installed' => 'boolean',
        'config' => 'array',
        'permissions' => 'array',
        'installed_at' => 'datetime',
    ];
}