<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin',
            'appointment-create-others',
            'appointment-create-own',
            'appointment-delete-others',
            'appointment-delete-own',
            'appointment-edit-others',
            'appointment-edit-own',
            'appointment-show-all',
            'appointment-show-own',
            'customer-delete-account',
            'customer-edit-profile',
            'product-create',
            'product-delete',
            'product-edit',
            'product-list',
            'role-create',
            'role-delete',
            'role-edit',
            'role-list',
            'specialist-delete-profile',
            'specialist-edit-profile',
            'super-admin'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
