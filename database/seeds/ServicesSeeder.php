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
            'Maths Tutor',
            'English Turor',
            'Wedding Photographer',
            'Event Photographer',
            'Electrition',
            'Computer Repair',
            'Electronics Repairing',
            'Yoga Trainer',
            'Dietician',
            'Personal Trainer'
        ];
        foreach($services as $service){
            Service::create([
                'name' => $service
            ]);    
        }
    }
}
