<?php

use App\Review;
use App\User;
use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Review::truncate();
        
        $customer = User::where('type', 'customer')->first();
        $serviceProvider = User::where('type', 'service-provider')->first();
        Review::create([
            'review' => "first review",
            'rating' => 4.5,
            'customer_id' => $customer->id,
            'service_provider_id' => $serviceProvider->id
        ]);
        Review::create([
            'review' => "second review",
            'rating' => 4,
            'customer_id' => $customer->id,
            'service_provider_id' => $serviceProvider->id
        ]);
        Review::create([
            'review' => "third review",
            'rating' => 3,
            'customer_id' => $customer->id,
            'service_provider_id' => $serviceProvider->id
        ]);
    }
}
