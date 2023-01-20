<?php

namespace Database\Seeders;

use Faker\Provider\Lorem;
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
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'super-admin',
            'appointment-show-own',
            'appointment-show-all',
            'appointment-create-own',
            'appointment-edit-own',
            'appointment-create-others',
            'appointment-edit-others',
            'appointment-delete-own',
            'appointment-delete-others',
            'customer-edit-profile',
            'customer-delete-account',
            'specialist-edit-profile',
            'specialist-delete-profile'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
