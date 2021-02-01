<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'fjcalerod@gmail.com ',
            'rol' => 1,
            'password' => bcrypt('mondalindo'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);      
      
        
        DB::table('users')->insert([                       
            'name' => 'Responsable1',
            'email' => 'responsable1@test.test',
            'rol' => 2,
            'password' => bcrypt('mondalindo'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
                  
        ]);
        
        DB::table('users')->insert([                       
            'name' => 'Responsable2',
            'email' => 'responsable2@test.test',
            'rol' => 2,
            'password' => bcrypt('mondalindo'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
                  
        ]);
        
        DB::table('users')->insert([                       
            'name' => 'Técnico 1',
            'email' => 'tecnico1@test.test',
            'rol' => 3,
            'password' => bcrypt('mondalindo'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
                  
        ]);
        
        DB::table('users')->insert([                       
            'name' => 'Técnico 2',
            'email' => 'tecnico2@test.test',
            'rol' => 3,
            'password' => bcrypt('mondalindo'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
                  
        ]);
        
        DB::table('users')->insert([                       
            'name' => 'Consultas',
            'email' => 'consulta@test.test',
            'rol' => 4,
            'password' => bcrypt('mondalindo'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
                  
        ]);
    }
}
