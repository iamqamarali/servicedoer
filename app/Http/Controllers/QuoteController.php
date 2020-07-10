<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Answer;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * 
     */
    public function show($quote){
        $quote = Quote::with('project')
                        ->with('serviceProvider')
                        ->find($quote);
        return $quote;
    }




     /**
      * 
      */
    public function requestQuote(Request $request, $provider, $project){
        $provider = User::findOrFail($provider);
        $project = Project::findOrFail($project);
        if($project->service_id != $provider->service_id){
            Session::forget('project');
            return redirect()->back();
        }
        $provider->notifications()->create([
            'data' => [
                'message' => 'New Quote Request from '.  auth()->user()->name,
                'type' => 1,
                'project_id' => $project->id,
                'customer_id' => auth()->user()->id
            ]
        ]);
        Session::forget('project');
        Session::flash('success', "We've requested " . $provider->name . " to check your project details and get back to you with a quote");
        return redirect()->route('service-provider.profile', $provider->id);
    }


    /**
     * 
     */
    public function createProjectRequestQuote(Request $request, $provider){
        $request->validate([
            'answers' => 'required',
            'question_answers' => 'required'
        ]);
        $provider = User::where('type', 'service-provider')->findOrFail($provider);
        $answer = Answer::find($request->answers[0]);
        $project = Project::create([
            'customer_id' => auth()->user()->id,
            'service_id' => $answer->question->service->id,
            'question_answers' => json_decode($request->question_answers, true)
        ]);
        $project->answers()->attach($request->answers);

        $provider->notifications()->create([
            'data' => [
                'message' => 'New Quote Request',
                'type' => 1,
                'project_id' => $project->id,
                'customer_id' => auth()->user()->id
            ]
        ]);
        Session::forget('project');

        Session::flash('success', "We've requested " . $provider->name . " to check your project details and get back to you with a quote");
        return redirect()->route('service-provider.profile', $provider->id);
    }


    /**
     * 
     * 
     */
    public function giveQuote(Request $request, $project){
        $project = Project::findOrFail($project);
        $request->validate([
            'quote' => 'required|numeric'
        ]);
        $provider = auth()->user();
        if($provider->connects <= 0){
            Session::flash('You do not have connects left to quote this customer');
        }
        $provider->connects = $provider->connects - 1;
        $provider->save();
        $quote = Quote::create([
            'quote' => $request->quote,
            'service_provider_id' => auth()->user()->id,
            'project_id' => $project->id,
            'customer_id' => $project->customer_id
        ]);
        $customer = User::findOrFail($project->customer_id);
        $customer->notifications()->create([
            'data' => [
                'message' => 'Quote received from ' . auth()->user()->name,
                'type' => 2,
                'quote_id' => $quote->id
            ],
        ]);

        Session::flash('success', 'Quote sent to customer');
        return redirect()->back();
    }

}
