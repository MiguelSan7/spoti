<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['nombre' => 'Administrador'],
            ['nombre' => 'Usuario'],
            ['nombre' => 'Invitado']
        ];
        
        foreach ($roles as $rol) {
            Roles::create($rol);
        }
    }
}
