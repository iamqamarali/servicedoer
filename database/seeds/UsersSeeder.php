<?php

use App\City;
use App\Location;
use App\Notification;
use App\Project;
use App\Quote;
use App\Service;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();
        User::truncate();
        Notification::truncate();
        Quote::truncate();


        $serviceProvider = User::create([
            'first_name' => 'Test ',
            'last_name' => 'Service Provider',
            'email' => 'serviceprovider@gmail.com',
            'password' => bcrypt('password'),
            'type' => 'service-provider',
        ]);
        $service = Service::first();
        $serviceProvider->city()->associate(City::where('name', 'Lahore')->first());
        $serviceProvider->service()->associate($service);
        $answewrs = [];
        foreach($service->questions as $q){
            $answewrs[] = $q->answers[0];
        }
        $serviceProvider->answers()->attach($answewrs);
        $serviceProvider->save();         
        $customer = User::create([
            'first_name' => 'Test',
            'last_name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'),
            'type' => 'customer',
            'city_id' => City::where('name', 'Lahore')->first()->id
        ]);
    }
}
