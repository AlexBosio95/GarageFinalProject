<?php

use App\Models\View;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 500; $i++) {
            $views = new View();
    
            $views->date = $faker->dateTimeBetween('-11 month', '+1 week');
            $views->ip_address = $faker->randomDigitNotZero();
            $views->save();
        }
    }
}
