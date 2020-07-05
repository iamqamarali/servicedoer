<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
        'service_provider_question',
        'type', // text, radio, checkbox
        'service_id',
        'question_number'// some number
    ];


    public function service(){
        return $this->belongsTo(Service::class);
    }


    public function answers(){
        return $this->hasMany(Answer::class);
    }
    
}
