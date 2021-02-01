<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('proyectos')->insert([
        'nom_proyecto' => 'Prueba 001',
        'users_id' => 4,
        'provincia' => "Toledo",
        'term_municipal' => "Illescas",
        'sociedad' => "Solar desolado",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ]); 
        
        DB::table('proyectos')->insert([
        'nom_proyecto' => 'Prueba 002',
        'users_id' => 4,
        'provincia' => "Madrid",
        'term_municipal' => "Madrid",
        'sociedad' => "Anónima",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ]);
        
        DB::table('proyectos')->insert([
        'nom_proyecto' => 'Prueba 003',
        'users_id' => 5,
        'provincia' => "Valladolid",
        'term_municipal' => "Peñafiel",
        'sociedad' => "Pandémica",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ]);
        
        DB::table('proyectos')->insert([
        'nom_proyecto' => 'Prueba 004',
        'users_id' => 5,
        'provincia' => "Albacete",
        'term_municipal' => "Albacete",
        'sociedad' => "Estructurada",
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ]);
        
        
        
        
    }
}
