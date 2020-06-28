<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;


class Notification extends Model
{
    protected $fillable = [
        'data', // =>[
                // type => 1 == quote request
                // type => 2 == quote received
                // type => 3 == order completed notification to service provider
                // type => 4 == customer left review
                // type => 5 == order cancelled
            // ]
        'read' // => true, false
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->read = false;
        });
    }


    /**
     * 
     * relationships
     */
    public function user(){
        return $this->belongsTo(User::class);
    }



}
