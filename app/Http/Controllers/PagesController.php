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
                ->withLahore(City::where('name', 'Lahore')->first())
                ->withTutor(Service::where('name', 'Tutor')->first())
                ->withElectrician(Service::where('name', 'Electrician')->first())
                ->withPlumber(Service::where('name', 'Plumber')->first())
                ->withMechanic(Service::where('name', 'Mechanic')->first())
                ->withPhotography(Service::where('name', 'Photography')->first())
                ->withHomeCleaning(Service::where('name', 'Home Cleaning')->first());
    }

    /**
     * 
     * 
     */
    public function serviceProviders(Request $request, $city, $service){
        $users = User::where('service_id', $service)->where('city_id', $city)->paginate(10);
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
                ->withReviews($provider->serviceProviderReviews()->latest()->paginate(5));
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
