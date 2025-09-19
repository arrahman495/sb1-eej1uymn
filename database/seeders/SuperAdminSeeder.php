<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin user
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'admin@ispsaas.com',
            'password' => Hash::make('password123'),
            'phone' => '+1234567890',
            'status' => 'active',
        ]);

        // Assign super admin role
        $superAdmin->assignRole('super_admin');

        // Create a demo ISP Owner
        $ispOwner = User::create([
            'name' => 'Demo ISP Owner',
            'email' => 'ispowner@demo.com',
            'password' => Hash::make('password123'),
            'phone' => '+1234567891',
            'status' => 'active',
            'created_by' => $superAdmin->id,
        ]);

        $ispOwner->assignRole('isp_owner');

        // Create a demo reseller
        $reseller = User::create([
            'name' => 'Demo Reseller',
            'email' => 'reseller@demo.com',
            'password' => Hash::make('password123'),
            'phone' => '+1234567892',
            'status' => 'active',
            'isp_owner_id' => $ispOwner->id,
            'commission_rate' => 10.00,
            'created_by' => $ispOwner->id,
        ]);

        $reseller->assignRole('reseller');

        // Create a demo sub reseller
        $subReseller = User::create([
            'name' => 'Demo Sub Reseller',
            'email' => 'subreseller@demo.com',
            'password' => Hash::make('password123'),
            'phone' => '+1234567893',
            'status' => 'active',
            'isp_owner_id' => $ispOwner->id,
            'reseller_id' => $reseller->id,
            'commission_rate' => 5.00,
            'created_by' => $reseller->id,
        ]);

        $subReseller->assignRole('sub_reseller');

        // Create a demo staff member
        $staff = User::create([
            'name' => 'Demo Staff',
            'email' => 'staff@demo.com',
            'password' => Hash::make('password123'),
            'phone' => '+1234567894',
            'status' => 'active',
            'isp_owner_id' => $ispOwner->id,
            'created_by' => $ispOwner->id,
        ]);

        $staff->assignRole('staff');

        $this->command->info('Demo users created successfully!');
        $this->command->info('Super Admin: admin@ispsaas.com / password123');
        $this->command->info('ISP Owner: ispowner@demo.com / password123');
        $this->command->info('Reseller: reseller@demo.com / password123');
        $this->command->info('Sub Reseller: subreseller@demo.com / password123');
        $this->command->info('Staff: staff@demo.com / password123');
    }
}