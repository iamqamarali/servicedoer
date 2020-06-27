<?php

use App\City;
use App\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Location::truncate();

        $locations = [
            'Johar town, Lahore',
            'Wapda town, Lahore',
            'Faisal town, Lahore',
            'Samnabad, Lahore',
            'Model town, Lahore',
            'DHA phase 1, Lahore',
            'DHA phase 2, Lahore'
        ];
        $lahore = City::where('name', 'Lahore')->first();
        foreach($locations as $location){
            Location::create([
                'name' => $location,
                'city_id' => $lahore->id
            ]);
        }

        
    }
}
