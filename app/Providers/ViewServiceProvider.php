<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['partials.header'], function($view){
            if(auth()->check()){
                $user = auth()->user();
                $notifications = $user->notifications()->where('read', false)->latest()->limit(15)->get();
//                $notifications = $user->notifications()->latest()->limit(15)->get();
                $view->with('notifications', $notifications);
            }
        });
    }
}
