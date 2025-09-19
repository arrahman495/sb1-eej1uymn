<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RolesAndUsersSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Create roles
        $roles = [
            [
                'id' => 1,
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Full system access with module management',
                'permissions' => json_encode([
                    'all_access', 'module_management', 'user_management', 
                    'system_settings', 'reports', 'billing'
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'isp_owner',
                'display_name' => 'ISP Owner',
                'description' => 'ISP owner with domain management and reseller creation',
                'permissions' => json_encode([
                    'domain_management', 'reseller_management', 'mikrotik_management',
                    'pop_management', 'user_management', 'reports', 'billing'
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'reseller',
                'display_name' => 'Reseller',
                'description' => 'Can create sub-resellers and manage PPPoE users',
                'permissions' => json_encode([
                    'sub_reseller_management', 'pppoe_user_management',
                    'pop_management', 'zone_management', 'reports'
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'sub_reseller',
                'display_name' => 'Sub Reseller',
                'description' => 'Can manage PPPoE users under assigned zones',
                'permissions' => json_encode([
                    'pppoe_user_management', 'zone_management', 'reports'
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'staff',
                'display_name' => 'Staff',
                'description' => 'Limited access for support and basic operations',
                'permissions' => json_encode([
                    'customer_support', 'basic_reports'
                ]),
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('roles')->insert($roles);

        // Create super admin user
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@ispsaas.com',
            'email_verified_at' => $now,
            'password' => Hash::make('password123'),
            'phone' => '+1234567890',
            'address' => 'System Administrator',
            'role_id' => 1,
            'parent_id' => null,
            'is_active' => true,
            'permissions' => json_encode(['all_access']),
            'settings' => json_encode([
                'theme' => 'default',
                'language' => 'en',
                'timezone' => 'UTC'
            ]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}