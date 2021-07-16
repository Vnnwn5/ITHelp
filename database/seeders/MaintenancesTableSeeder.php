<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Maintenance::factory()->count(1)->create([
            'name' => 'Reparacion de PC escritorio Nivel I',
            'price' => '70.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'Reparacion de PC escritorio Nivel II',
            'price' => '100.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'Reparacion de PC escritorio Nivel III',
            'price' => '150.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'Limpieza de pc escritorio',
            'price' => '70.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'Limpieza de laptop',
            'price' => '85.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'reparacion smart phone nivel I',
            'price' => '120.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'reparacion smarth phone nivel II',
            'price' => '150.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'reparacion smarth phone nivel III',
            'price' => '140.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'formateo de computadora ',
            'price' => '130.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'Formateo de Smartphone',
            'price' => '160.00'
        ]);
        Maintenance::factory()->count(1)->create([
            'name' => 'limpieza de impresora',
            'price' => '180.00'
        ]);
    }
}
