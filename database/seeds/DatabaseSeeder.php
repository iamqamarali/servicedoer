<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServicesSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(ReviewTableSeeder::class);   
        $this->call(SubscriptionPackagesSeeder::class);
    }
}
