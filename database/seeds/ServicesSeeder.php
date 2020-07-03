<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::truncate();
        $services = [
            'Tutor',
            'Electrician',
            'Plumber',
            'Mechanic',
            'Photography',
            'Home Cleaning',
        ];
        foreach($services as $service){
            Service::create([
                'name' => $service
            ]);    
        }
    }
}
