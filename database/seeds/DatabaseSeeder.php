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
        //$this->call(GaragesSeeder::class);
        //$this->call(SponsorSeeder::class);
        //$this->call(ServicesSeeder::class);
        $this->call(ViewsSeeder::class);
    }
}
