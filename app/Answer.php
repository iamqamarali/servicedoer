<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'answer', 'question_id',
    ];


    public function question(){
        return $this->belongsTo(Question::class);
    }


    public function project(){
        return $this->belongsToMany(Project::class);
    }

}
