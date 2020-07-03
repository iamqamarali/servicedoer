<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'status',
        'package_id',
        'trial_till_date',
        'stripe_charge_id'
    ];

    protected $casts = [
        'trial_till_date'
    ];

    /**
     * 
     */
    public function package(){
        $this->belongsTo(SubscriptionPackage::class);
    }

    /**
     * 
     */
    public function service_provider(){
        return $this->belongsTo(User::class);
    }

}
