<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrador',
                'description' => 'Administrador de la aplicación',
            ],
            [
                'name' => 'Usuario',
                'description' => 'Usuario de la aplicación',
            ],
        ];

        foreach ($roles as $role) {
            Roles::create($role);
        }
    }
}
