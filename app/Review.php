<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'review', 'rating',
        'customer_id',
        'service_provider_id'
    ];


    /**
     * customer relation
     */
    public function customer(){
        return $this->belongsTo(User::class);
    }


    /**
     * Service provider relation
     */
    public function service_provider(){
        return $this->belongsTo(User::class);
    }




}
