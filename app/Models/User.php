<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'isp_owner_id',
        'reseller_id',
        'sub_reseller_id',
        'commission_rate',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'commission_rate' => 'decimal:2',
        ];
    }

    /**
     * Get the ISP owner that owns this user
     */
    public function ispOwner()
    {
        return $this->belongsTo(User::class, 'isp_owner_id');
    }

    /**
     * Get the reseller that owns this user
     */
    public function reseller()
    {
        return $this->belongsTo(User::class, 'reseller_id');
    }

    /**
     * Get the sub reseller that owns this user
     */
    public function subReseller()
    {
        return $this->belongsTo(User::class, 'sub_reseller_id');
    }

    /**
     * Get the user who created this user
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get users created by this user
     */
    public function createdUsers()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    /**
     * Get resellers under this ISP owner
     */
    public function resellers()
    {
        return $this->hasMany(User::class, 'isp_owner_id')->whereHas('roles', function ($query) {
            $query->where('name', 'reseller');
        });
    }

    /**
     * Get sub resellers under this reseller
     */
    public function subResellers()
    {
        return $this->hasMany(User::class, 'reseller_id')->whereHas('roles', function ($query) {
            $query->where('name', 'sub_reseller');
        });
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Check if user is ISP owner
     */
    public function isIspOwner(): bool
    {
        return $this->hasRole('isp_owner');
    }

    /**
     * Check if user is reseller
     */
    public function isReseller(): bool
    {
        return $this->hasRole('reseller');
    }

    /**
     * Check if user is sub reseller
     */
    public function isSubReseller(): bool
    {
        return $this->hasRole('sub_reseller');
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->hasRole('staff');
    }
}