<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
class RoleSeeder extends Seeder

{

    public function run(): void
    {
       $roles = [
            [
                'name'         => 'super_admin',
                'display_name' => 'Super Administrator',
                'description'  => 'Full access. Cannot be deleted by admins.',
            ],
            [
                'name'         => 'admin',
                'display_name' => 'Administrator',
                'description'  => 'Full admin panel access.',
            ],
            [
                'name'         => 'staff',
                'display_name' => 'Staff',
                'description'  => 'Can update order delivery status only.',
            ],
            [
                'name'         => 'customer',
                'display_name' => 'Customer',
                'description'  => 'Storefront access only.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}
