<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'status', // created | quoted,
        'customer_id',
        'service_id',
        'answer_ids',

        'question_answers'
    ]; 

    protected $appends = [
        'id', 'questions'
    ];

    /**
     * 
     */
    public function customer(){
        return $this->belongsTo(User::class);
    }

    /**
     * 
     */
    public function service(){
        return $this->belongsTo(Service::class);
    }

    /**
     *  
     */
    public function answers(){
        return $this->belongsToMany(Answer::class);
    }


    /**
     * 
     * 
     */
    public function getQuestionsAttribute(){
        $questions = collect();
        $i = 0;
        foreach($this->question_answers as $qa){
            $questions->push(Question::with(['answers' => function($query)use($qa){
                $query->whereIn('_id', $qa['answers']);
            }])->find($qa['question']));
        }
        return $questions;
    }
    
}
