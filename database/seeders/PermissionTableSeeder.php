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
            'appointment-list',
            'appointment-create',
            'appointment-edit',
            'appointment-delete',
            'customer-view',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'specialist-view',
            'specialist-list',
            'specialist-create',
            'specialist-edit',
            'specialist-delete',
            'company-view',
            'company-list',
            'company-create',
            'company-edit',
            'company-delete',
            'super-admin',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
