<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'city_id'
    ];


    public function city(){
        return $this->belongsTo(City::class);
    }

}
