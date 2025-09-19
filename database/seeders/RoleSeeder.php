<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $roles = [
            'super_admin',
            'isp_owner',
            'reseller',
            'sub_reseller',
            'staff',
            'customer'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Create permissions
        $permissions = [
            // Super Admin permissions
            'manage_isp_owners',
            'manage_modules',
            'view_all_reports',
            'system_settings',
            
            // ISP Owner permissions
            'manage_domains',
            'manage_resellers',
            'manage_mikrotiks',
            'manage_pppoe_users',
            'manage_pop_zones',
            'view_billing',
            
            // Reseller permissions
            'manage_customers',
            'manage_sub_resellers',
            'view_commission',
            
            // Sub Reseller permissions
            'manage_sub_customers',
            'view_sub_commission',
            
            // Staff permissions
            'view_assigned_tasks',
            'manage_tickets',
            
            // Customer permissions
            'view_profile',
            'view_usage',
            'view_billing_history',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdmin = Role::findByName('super_admin');
        $superAdmin->givePermissionTo(Permission::all());

        $ispOwner = Role::findByName('isp_owner');
        $ispOwner->givePermissionTo([
            'manage_domains',
            'manage_resellers',
            'manage_mikrotiks',
            'manage_pppoe_users',
            'manage_pop_zones',
            'view_billing',
        ]);

        $reseller = Role::findByName('reseller');
        $reseller->givePermissionTo([
            'manage_customers',
            'manage_sub_resellers',
            'view_commission',
        ]);

        $subReseller = Role::findByName('sub_reseller');
        $subReseller->givePermissionTo([
            'manage_sub_customers',
            'view_sub_commission',
        ]);

        $staff = Role::findByName('staff');
        $staff->givePermissionTo([
            'view_assigned_tasks',
            'manage_tickets',
        ]);

        $customer = Role::findByName('customer');
        $customer->givePermissionTo([
            'view_profile',
            'view_usage',
            'view_billing_history',
        ]);
    }
}