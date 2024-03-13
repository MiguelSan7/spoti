<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Suscripciones;

class SuscripcionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suscripciones = [
            ['nombre' => 'Gratis', 'Precio' => 0.00, 'Duracion' => '1 Mes'],
            ['nombre' => 'Premium', 'Precio' => 9.99, 'Duracion' => '1 Mes'],
            ['nombre' => 'Familiar', 'Precio' => 14.99, 'Duracion' => '1 Mes'],
            ['nombre' => 'Estudiante', 'Precio' => 4.99, 'Duracion' => '1 Mes'],
        ];

        foreach ($suscripciones as $suscripcion) {
            Suscripciones::create($suscripcion);
        }
    }
}
