<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProyectoSeeder::class);
        $this->call(OrganismoSeeder::class);
        $this->call(HitosSeeder::class);
        $this->call(FincasSeeder::class);
        
    }
}
