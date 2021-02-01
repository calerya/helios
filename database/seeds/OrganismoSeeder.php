<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganismoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
     DB::table('organismos')->insert([
        'proyecto_id' => 1,
        'organismo' => 'Ministerio de prueba',
        'num_expediente' => "Pruebas 001",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);
        
    DB::table('organismos')->insert([
        'organismo' => 'Ayuntamiento de Prueba',
        'proyecto_id' => 1,
        'num_expediente' => "Pruebas 002",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);

    DB::table('organismos')->insert([
        'proyecto_id' => 1,
        'organismo' => 'Administración de prueba',
        'num_expediente' => "Pruebas 003",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);
        
    DB::table('organismos')->insert([
        'organismo' => 'Conferación de Prueba',
        'proyecto_id' => 1,
        'num_expediente' => "Pruebas 004",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);
        
    DB::table('organismos')->insert([
        'proyecto_id' => 2,
        'organismo' => 'Ministerio de prueba',
        'num_expediente' => "Pruebas 005",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);
        
    DB::table('organismos')->insert([
        'organismo' => 'Ayuntamiento de Prueba',
        'proyecto_id' => 2,
        'num_expediente' => "Pruebas 006",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);

    DB::table('organismos')->insert([
        'proyecto_id' => 3,
        'organismo' => 'Administración de prueba',
        'num_expediente' => "Pruebas 007",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);
        
    DB::table('organismos')->insert([
        'organismo' => 'Conferación de Prueba',
        'proyecto_id' => 4,
        'num_expediente' => "Pruebas 008",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        
    ]);
     
        
    }
}
