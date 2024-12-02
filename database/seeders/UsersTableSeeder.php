<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'user_name' => 'admin_user',
            'apellidos' => 'Admin Apellidos',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            // 'fecha_registro' => now(),
            'rol' => 1, // Administrador
        ]);

        User::create([
            'name' => 'Usuario Normal',
            'user_name' => 'normal_user',
            'apellidos' => 'Normal Apellidos',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            // 'fecha_registro' => now(),
            'rol' => 0, // Usuario normal
        ]);

        User::create([
            'name' => 'Moderador',
            'user_name' => 'moderador_user',
            'apellidos' => 'Mod Apellidos',
            'email' => 'moderador@example.com',
            'password' => Hash::make('mod123'),
            // 'fecha_registro' => now(),
            'rol' => 0, // Usuario normal
        ]);
    }
}
