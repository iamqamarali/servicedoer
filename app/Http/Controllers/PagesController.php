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
        $users = User::where('service_id', $service)->where('city_id', $city)->paginate(20);
        $service = Service::findOrFail($service);
        return view('service-providers')
                ->withUsers($users)
                ->withService($service)
                ->withQuestions($service->questions()->with("answers")->get());
    }

    /**
     * 
     */
    public function bestServiceProvider(Request $request, $city, $service, $project){
        $project = Project::find($project);
        // fetch users
        $provider = User::raw(function($collection)use ($project, $city, $service){
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
                '$match'=>[
                    'city_id' => $city,
                    'service_id' => $service,
                    'search' => true
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
                '$limit' => 1
            ]
            ]);
        });

        return view('best-provider')->withProvider(isset($provider[0])?$provider[0] : null);
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
                ->withOrders($provider->service_provider_orders()->where('status', 'Completed')->get())
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
        return view('customer.complete-profile.step3')
                ->withPackages(SubscriptionPackage::all());
    }


    /**
     * 
     * 
     */
    public function customerCompleteProfileStep2(){
        return view('customer.complete-profile.step2')
                ->withCities(City::all());
    }


}
