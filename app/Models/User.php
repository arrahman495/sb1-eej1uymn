<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'role_id',
        'parent_id',
        'is_active',
        'permissions',
        'settings',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'is_active' => 'boolean',
            'permissions' => 'array',
            'settings' => 'array',
            'last_login_at' => 'datetime',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function ispDomains()
    {
        return $this->hasMany(IspDomain::class);
    }

    public function mikrotikRouters()
    {
        return $this->hasMany(MikrotikRouter::class);
    }

    public function pops()
    {
        return $this->hasMany(Pop::class);
    }

    public function pppoeUsers()
    {
        return $this->hasMany(PppoeUser::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function hasPermission($permission)
    {
        if ($this->role && $this->role->permissions) {
            return in_array($permission, $this->role->permissions) || in_array('all_access', $this->role->permissions);
        }

        if ($this->permissions) {
            return in_array($permission, $this->permissions) || in_array('all_access', $this->permissions);
        }

        return false;
    }

    public function isSuperAdmin()
    {
        return $this->role && $this->role->name === 'super_admin';
    }

    public function isIspOwner()
    {
        return $this->role && $this->role->name === 'isp_owner';
    }

    public function isReseller()
    {
        return $this->role && $this->role->name === 'reseller';
    }

    public function isSubReseller()
    {
        return $this->role && $this->role->name === 'sub_reseller';
    }

    public function isStaff()
    {
        return $this->role && $this->role->name === 'staff';
    }
}
