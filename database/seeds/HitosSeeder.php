<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HitosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hitos')->insert([                       
            'proyecto_id' => 1,
            'hito_numero' => 1,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
            'fec_contest' => Carbon::now(),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 1,
            'hito_numero' => 2,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('hitos')->insert([                       
            'proyecto_id' => 1,
            'hito_numero' => 3,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 1,
            'hito_numero' => 4,
            'fec_sol_ind' => Carbon::now(),
        
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 1,
            'hito_numero' => 5,
                     
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 2,
            'hito_numero' => 1,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
            'fec_contest' => Carbon::now(),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 2,
            'hito_numero' => 2,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('hitos')->insert([                       
            'proyecto_id' => 2,
            'hito_numero' => 3,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 2,
            'hito_numero' => 4,
            'fec_sol_ind' => Carbon::now(),
        
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 2,
            'hito_numero' => 5,
                     
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 3,
            'hito_numero' => 1,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
            'fec_contest' => Carbon::now(),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 3,
            'hito_numero' => 2,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('hitos')->insert([                       
            'proyecto_id' => 3,
            'hito_numero' => 3,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 3,
            'hito_numero' => 4,
            'fec_sol_ind' => Carbon::now(),
        
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 3,
            'hito_numero' => 5,
                     
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 4,
            'hito_numero' => 1,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
            'fec_contest' => Carbon::now(),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 4,
            'hito_numero' => 2,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
            'fec_com_dis' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('hitos')->insert([                       
            'proyecto_id' => 4,
            'hito_numero' => 3,
            'fec_sol_ind' => Carbon::now(),
            'fec_obt_ind' => Carbon::now(),
                      
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 4,
            'hito_numero' => 4,
            'fec_sol_ind' => Carbon::now(),
        
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

        DB::table('hitos')->insert([                       
            'proyecto_id' => 4,
            'hito_numero' => 5,
                     
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 

    }
}
