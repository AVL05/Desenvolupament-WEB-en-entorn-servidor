<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleId1 = DB::table('vehiculo')->insertGetId([
            'matricula' => '1234COR',
            'marca' => 'Opel',
            'modelo' => 'Corsa',
            'anyo_fab' => 2016,
            'foto' => 'https://imgs.search.brave.com/gk8095FR_TO7kUm5yt33DhBcoFymQWpmr1VkE_GCpKU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jbXMt/YXNzZXRzLmF1dG9z/Y291dDI0LmNvbS91/YWRkeDA2aXd6ZHov/MVVjbEdCbndIdWR5/a2F2eUhDZE5LaS80/NzU4Mjc1ZTAwNDA3/NjU0NDM3NWFmZmI2/M2U5ZmYxYy9taWdy/YXRpb24tZGUtZGUt/NDk4MDE3LW16XzIw/MTYtNS00X3VzZWRj/YXJ0ZXN0X29wZWxf/Y29yc2FfZF90b3At/NTAwLmpwZz93PTEx/MDA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $vehicleId2 = DB::table('vehiculo')->insertGetId([
            'matricula' => '5678TOY',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'anyo_fab' => 2020,
            'foto' => 'https://imgs.search.brave.com/3mFD82sNyKY6Ns55lElNKauVN3qXaYAIzOcvTITjSJs/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9mb3Rv/cy5xdWVjb2NoZW1l/Y29tcHJvLmNvbS90/b3lvdGEtY29yb2xs/YS8zODEwNDQxNy5q/cGc_c2l6ZT0zNzB4/MjAw',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $vehicleId3 = DB::table('vehiculo')->insertGetId([
            'matricula' => '9012MUS',
            'marca' => 'Ford',
            'modelo' => 'Mustang',
            'anyo_fab' => 2018,
            'foto' => 'https://imgs.search.brave.com/UUy8j66X2IMne92b7eLlqZFFGdg-Q_h6pBrwwu-tBDQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/d2FsbGFwb3AuY29t/L2ltYWdlcy8xMDQy/MC9rNC9vbi9fXy9j/MTA0MjBwMTIxNzE5/MTU1NS9pNjIwNjU4/ODQwNy5qcGc_cGlj/dHVyZVNpemU9VzMy/MA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $vehicleId4 = DB::table('vehiculo')->insertGetId([
            'matricula' => '3456MIN',
            'marca' => 'Mini',
            'modelo' => 'Cooper',
            'anyo_fab' => 2019,
            'foto' => 'https://imgs.search.brave.com/oQPXO_blguC6wzQbVhUc7IP_gPjJT_mv174sVxA5BdE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jbXMt/YXNzZXRzLmF1dG9z/Y291dDI0LmNvbS91/YWRkeDA2aXd6ZHov/NFRYZzYyOWJGWmp2/OXhlNjV5OGV3Ty83/NmU0M2RjYWExMGQ5/ZTYxOTZhNDNhYTMx/ZmIzOGJlMi9taW5p/LWNvb3Blci1kLWNs/dWJtYW4tbC0wMS5q/cGc_dz00ODA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('poliza')->insert([
            [
                'id_vehiculo' => $vehicleId1,
                'tipo' => 'Todo Riesgo',
                'importe' => 500.00,
                'fecha_comienzo' => now()->subYear(),
                'fecha_renovacion' => now()->addMonth(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $vehicleId2,
                'tipo' => 'Terceros',
                'importe' => 300.50,
                'fecha_comienzo' => now()->subMonths(6),
                'fecha_renovacion' => now()->addMonths(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $vehicleId3,
                'tipo' => 'Franquicia',
                'importe' => 450.00,
                'fecha_comienzo' => now()->subMonths(2),
                'fecha_renovacion' => now()->addMonths(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'id_vehiculo' => $vehicleId4,
                'tipo' => 'Todo Riesgo',
                'importe' => 600.00,
                'fecha_comienzo' => now()->subMonths(1),
                'fecha_renovacion' => now()->addMonths(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
