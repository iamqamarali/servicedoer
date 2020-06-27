<?php

namespace App\Http\Controllers;

use App\City;
use App\Project;
use App\Service;
use App\SubscriptionPackage;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        return view('home')
                ->withCities(City::all())
                ->withPhotography(Service::where('name', 'Event Photographer')->first())
                ->withYogaTrainer(Service::where('name', 'Yoga Trainer')->first())
                ->withDietician(Service::where('name', 'Dietician')->first())
                ->withPersonalTrainer(Service::where('name', 'Personal Trainer')->first());
    }

    /**
     * 
     * 
     */
    public function serviceProviders(Request $request, $city, $service){

        $page = $request->query('page') ? $request->query('page') : 1;
        $page--;
        $limit = 10;

        if($request->query('project')){
            $project = Project::find($request->project);
            // fetch users
            $users = User::raw(function($collection)use ($project, $page, $limit){
                return $collection->aggregate([
                [

                    '$addFields' => [
                        "matching" =>[
                            '$setIntersection' => ['$answer_ids', $project->answer_ids]
                        ]
                    ]
                ], 
                [
                    '$match'=>[
                        'matching' => [
                            '$ne' => null
                        ]
                    ]
                ],
                [
                    '$addFields'=>[
                        'count' =>[
                            '$size' => '$matching'
                        ]
                    ]
                ],
                [
                    '$sort' => [
                        "count" => -1
                    ]
                ], 
                [
                    '$skip' => $page * $limit
                ],
                [
                    '$limit' => $limit
                ]
                ]);
            });
        }else{
            $users = User::where('service_id', $service)->where('city_id', $city)->skip($page*$limit)->limit($limit)->get();
        }
        $service = Service::findOrFail($service);
        return view('service-providers')
                ->withUsers($users)
                ->withService($service)
                ->withQuestions($service->questions()->with("answers")->get());
    }

    /**
     *  
     * 
     */
    public function serviceProviderByService($service){
        $service = Service::findOrFail($service);
        return view('service-providers')
                ->withUsers(User::where('service_id', $service)->paginate(10))
                ->withCities(City::all())
                ->withService(Service::findOrFail($service))
                ->withService($service)
                ->withQuestions($service->questions()->with("answers")->get());
    }


    /**
     * 
     * 
     * 
     */
    public function serviceProviderProfile($serviceProvider){
        $provider = User::findOrFail($serviceProvider);
        return view('profile')
                ->withProvider($provider)
                ->withReviews($provider->serviceProviderReviews()->paginate(5));
    }


    /**
     * 
     * 
     * 
     */
    public function completeProfileStep2(){
        return view('complete-profile.step2')
                ->withCities(City::all())
                ->withServices(Service::all());
    }


    /**
     * 
     * 
     */
    public function completeProfileStep3(){
        return view('complete-profile.step3')
                ->withPackages(SubscriptionPackage::all());
    }

}
