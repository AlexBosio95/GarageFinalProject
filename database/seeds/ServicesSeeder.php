<?php

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'Surveillance',
            'Electricity',
            'Automatic',
            'Soundproof',
            'NFC key'
        ];

        foreach($services as $service) {
            $newService = new Service();

            $newService->name = $service;
            $newService->slug = Str::slug($service);

            $newService->save();
        }
    }
}
