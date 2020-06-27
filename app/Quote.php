<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'quote', 'project_id', 'service_provider_id', 'customer_id'
    ];

    /**
     * 
     */
    public function project(){
        return $this->belongsTo(Project::class);
    }


     /**
      * 
      */
    public function serviceProvider(){
        return $this->belongsTo(User::class, 'service_provider_id');
    }

    /**
     * 
     * 
     */
    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    
}
