<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class City extends Model
{
    protected $fillable = [
        'name'
    ];


    public function users(){
        return $this->hasMany(User::class);
    }

    /**
     * 
     */
    public function locations(){
        return $this->hasMany(Location::class);
    }

}
