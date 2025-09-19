<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'version',
        'file_path',
        'is_active',
        'configuration',
        'dependencies',
        'uploaded_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'configuration' => 'array',
        'dependencies' => 'array',
    ];

    /**
     * Get the user who uploaded this module
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}