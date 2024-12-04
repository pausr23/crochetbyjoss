<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Navidad',
                'logo' => 'images/categories/navidad.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Graduación',
                'logo' => 'images/categories/graduacion.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flores',
                'logo' => 'images/categories/flores.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bolsos',
                'logo' => 'images/categories/bolsos.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Macotas',
                'logo' => 'images/categories/mascotas.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Famosos',
                'logo' => 'images/categories/famosos.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Series y Películas',
                'logo' => 'images/categories/seriesypeliculas.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sets de apego',
                'logo' => 'images/categories/setsdeapego.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Otros',
                'logo' => 'images/categories/otros.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
