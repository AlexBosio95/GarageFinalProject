<?php

use App\Models\Garage;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class GaragesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<50; $i++) {
            $newGarage = new Garage();
            $newGarage->title = $faker->sentence();
            $newGarage->sqmt = $faker->numberBetween(20, 150);
            $newGarage->length = $faker->numberBetween(3, 20);
            $newGarage->width = $faker->numberBetween(1, 20);
            $newGarage->height = $faker->numberBetween(2, 4);
            $newGarage->n_parking = $faker->numberBetween(1, 4);
            $newGarage->address = $faker->address();
            $newGarage->longitude = $faker->randomDigit();
            $newGarage->latitude = $faker->randomDigit();
            $newGarage->description = $faker->paragraph();

            $newGarage->save();
        }
    }
}
