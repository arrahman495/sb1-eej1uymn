<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_name',
        'txt_record_key',
        'txt_record_value',
        'is_verified',
        'verified_at',
        'isp_owner_id',
        'ssl_certificate',
        'ssl_expiry_date',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
        'ssl_expiry_date' => 'datetime',
    ];

    /**
     * Get the ISP owner that owns this domain
     */
    public function ispOwner()
    {
        return $this->belongsTo(User::class, 'isp_owner_id');
    }
}