<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Generos;

class GenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generos = [
            ['nombre' => 'Rock'],
            ['nombre' => 'Pop'],
            ['nombre' => 'Jazz'],
            ['nombre' => 'Hip Hop'],
            ['nombre' => 'Regional Mexicano'],
            ['nombre' => 'Banda'],
            ['nombre' => 'Cumbia'],
            ['nombre' => 'Electronic'],
            ['nombre' => 'Reggae'],
            ['nombre' => 'Blues'],
            ['nombre' => 'Latin'],
            ['nombre' => 'Metal'],
            ['nombre' => 'Folk'],
            ['nombre' => 'Punk'],
            ['nombre' => 'Soul'],
            ['nombre' => 'Alternative'],
            ['nombre' => 'Reggaeton'],
            ['nombre' => 'Indie'],
            ['nombre' => 'K-Pop'],
            ['nombre' => 'Gospel'],
        ];

        foreach ($generos as $genero) {
            Generos::create($genero);
        }
    }
}
