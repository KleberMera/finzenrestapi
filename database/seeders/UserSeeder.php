<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'rol_id' => 1,
                'name' => 'Kleber',
                'last_name' => 'Pillasagua',
                'username' => 'KleberM',
                'user' => 'kapm',
                'email' => 'kleber.pillasagua@gmail.com',
                'password' => '123456789',
                'phone' => '',
                'status' => true,
            ],
            [
                'rol_id' => 2,
                'name' => 'Usuario',
                'last_name' => 'Usuario',
                'username' => 'usuario',
                'user' => 'usuario',
                'email' => 'usuario@usuario.com',
                'password' => 'usuario',
                'phone' => '123456789',
                'status' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
