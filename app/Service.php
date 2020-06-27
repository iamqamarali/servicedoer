<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'name'
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function serviceProviders(){
        return $this->belongsToMany(User::class, 'service_provider_ids');
    }
    
}
