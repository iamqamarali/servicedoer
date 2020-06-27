<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email', 
        'password',
        
        'bio',
        'address',
        'phone',
        
        'city_id',
        'service_id',
        'answer_ids',

        'incomplete_profile',  // true
        'incomplete_profile_step',
        'profile_image',

        'question_answers',

        'connects',

        'rating',


        'type' // admin, customer, service-provider
    ];

    protected $appends = [
        'id', 'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->rating = 0;
        });
    }



    /**
     * -------------
     *  for customers and service providers\
     * ---------
     */

     /**
      * 
      */
    public function bookings(){
        return $this->hasMany(Booking::Class);
    }

    /**
     * 
     */
    public function quotes(){
        return $this->hasMany(Quote::class);
    }


    /**
     * 
     * 
     */
    public function notifications(){
        return $this->hasMany(Notification::class);        
    }

    /**
     * ------------------------
     * for service providers
     * ----------------------
     */

    /**
     * 
     * services
     */
    public function service(){
        return $this->belongsTo(Service::class);
    }

    /**
     * 
     */
    public function service_provider_orders(){
        return $this->hasMany(Order::class, 'service_provider_id');
    }

    /**
     * 
     * 
     */
    public function subscription(){
        return $this->hasOne(Subscription::class, 'service_provider_id');
    }


    /**
     * 
     * answers 
     */
    public function answers(){
        return $this->belongsToMany(Answer::class);
    }

    /**
     * 
     * city
     */
    public function city(){
        return $this->belongsTo(City::class);
    }


    /**
     *  service provider reviews
     */
    public function serviceProviderReviews(){
        return $this->hasMany(Review::class, 'service_provider_id');
    }

    /**
     * 
     * customer reviews
     */
    public function customerReviews(){
        return $this->hasMany(Review::class, 'customer_id');
    }

    /**
     * 
     */
    public function customer_orders(){
        return $this->hasMany(Order::class, 'customer_id');
    }



    /**
     * --------------------
     * core functions
     * -------------------
     */

    public function getIsCustomerAttribute(){
        return $this->type == 'customer';
    }

    /**
     * 
     */
    public function getIsServiceProviderAttribute(){
        return $this->type == 'service-provider';
    }


    
    /**
     * 
     * get Attributes
     */
    public function getNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }


}
