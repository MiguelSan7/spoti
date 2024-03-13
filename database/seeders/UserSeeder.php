<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = [
            'nombres' => 'Miguel',
            'apellidos' => 'Villalpando',
            'email' => 'miguelvillalpando19@gmail.com',
            'activated_at' => now(),
            'password' => Hash::make('12345678'),
            'id_rol' => 1,
            'id_suscripcion' => 1,
            'estado' => true
        ];
        User::create($usuario);
    }
}
