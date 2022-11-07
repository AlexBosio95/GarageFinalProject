<?php

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'name' => 'Standard',
                'period' => 24,
                'price' => 2.99
            ],
            [
                'name' => 'Gold',
                'period' => 72,
                'price' => 5.99
            ],
            [
                'name' => 'Premium',
                'period' => 144,
                'price' => 9.99
            ]
        ]; 

        foreach($sponsors as $sponsor) {
            $newSponsor = new Sponsor();

            $newSponsor->name = $sponsor['name'];
            $newSponsor->period = $sponsor['period'];
            $newSponsor->price = $sponsor['price'];

            $newSponsor->save();
        }
    }
}
