<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Incident::create([
            'title' => 'Fallo de red',
            'description' => 'No hay conexión en la planta 2',
            'priority' => 'high',
            'status' => false,
            'user_id' => 1,
        ]);

        \App\Models\Incident::create([
            'title' => 'PC lento',
            'description' => 'El ordenador de recepción va muy lento',
            'priority' => 'medium',
            'status' => false,
            'user_id' => 1,
        ]);

        \App\Models\Incident::create([
            'title' => 'Ratón roto',
            'description' => 'El ratón no funciona',
            'priority' => 'low',
            'status' => true,
            'user_id' => 1,
        ]);

        \App\Models\Incident::create([
            'title' => 'Pantalla parpadea',
            'description' => 'El monitor se apaga a veces',
            'priority' => 'medium',
            'status' => false,
            'user_id' => 1,
        ]);

        \App\Models\Incident::create([
            'title' => 'Instalar Office',
            'description' => 'Necesito Excel urgente',
            'priority' => 'high',
            'status' => false,
            'user_id' => 1,
        ]);
    }
}
