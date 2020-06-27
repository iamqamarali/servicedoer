<?php

use App\Subscription;
use App\SubscriptionPackage;
use Illuminate\Database\Seeder;

class SubscriptionPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::truncate();
        SubscriptionPackage::truncate();

        SubscriptionPackage::create([
            'name' => 'Starter Package',
            'time_period' => '1 month',
            'price' => 3000,
            'connects' => 20,
            'trial_days' => 30
        ]);

        SubscriptionPackage::create([
            'name' => 'Standard Package',
            'time_period' => '1 month',
            'price' => 5000,
            'connects' => 40,
            'trial_days' => 30
        ]);

        SubscriptionPackage::create([
            'name' => 'Professional Package',
            'time_period' => '1 month',
            'price' => 10000,
            'connects' => 100,
            'trial_days' => 30
        ]);

    }
}
