<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'SuperAdmin',
            'Customer',
            'Especialista',
            'Company'
        ];

        foreach ($roles as $rol) {
            Role::create(['name' => $rol]);
        }
    }
}
