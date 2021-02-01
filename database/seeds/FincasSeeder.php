<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FincasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fincas')->insert([
            'proyecto_id' => 1,
            'ref_catastral' => "45100A032000260000KL",
            'provincia' => "Toledo",
            'municipio' => "Méntrida",
            'zona' => "Pozo de secano",
            'poligono' => '23',
            'parcela' => '46',
            'uso' => 'agrario',
            'venta_alq' => "venta",
            'sup_catastral_ha' => 5.4322,
            'sup_util_ha' => 5.4322,


            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
    }
}
