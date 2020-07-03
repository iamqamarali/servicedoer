<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status', 'amount','project_id', 'service_provider_id', 'customer_id',
        'cancellation_reason'
    ];


    /**
     * relations
     */
    public function project(){
        return $this->belongsTo(Project::class);
    }


    /**
     * 
     */
    public function service_provider(){
        return $this->belongsTo(User::class);
    }

    /**
     * 
     * 
     */
    public function customer(){
        return $this->belongsTo(User::class);
    }

}
