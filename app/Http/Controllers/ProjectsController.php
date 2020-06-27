<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectsController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * 
     * 
     */
    public function create(Request $request){
        $request->validate([
            'answers' => 'required',
            'question_answers' => 'required'
        ]);
        $answer = Answer::find($request->answers[0]);
        $project = Project::create([
            'customer_id' => auth()->user()->id,
            'service_id' => $answer->question->service->id,
            'question_answers' => json_decode($request->question_answers, true)
        ]);
        $project->answers()->attach($request->answers);
        Session::flash('success', "Your request has been taken here are the best matching results for your project");
        Session::put('project', $project->id);
        $url = url()->previous();
        return redirect($url.'?project='.$project->id);
    }



    /**
     * 
     * 
     * 
     */
    public function show($project){
        return Project::with('customer')
                        ->with('service')
                        ->findOrFail($project);        
    }

}
