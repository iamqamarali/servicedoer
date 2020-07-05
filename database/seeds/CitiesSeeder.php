<?php

use App\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();
        $cities = [
            'Lahore', 
            'Islamabad',
            'Faisalabad',
            'Rawalpindi'
        ];
        foreach($cities as $city){
            City::create([
                'name' => $city
            ]);    
        }
    }
}
