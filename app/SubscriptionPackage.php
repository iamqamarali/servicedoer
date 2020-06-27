<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class SubscriptionPackage extends Model
{
    protected $fillable = [
        'name', 
        'connects',
        'time_period',
        'price', 
        'trial_days'
    ];



    
}
