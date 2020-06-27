<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct()
    {
        
    }


    public function search(Request $request){
        $query = $request->query('query');

        if(!$query ){
            return collect();
        }        

        $services = Service::raw(function($collection) use($query){
            return $collection->aggregate([
                [
                    '$addFields' => [
                        'lower_name' => [                         
                            '$toLower' => '$name' 
                        ]
                    ]
                ],
                [
                    '$match' => [
                        'lower_name' => [
                            '$regex' =>  '.*' . $query . '.*'
                        ],
                    ]
                ],
                [
                    '$limit' => 10
                ]
            ]);
        });

        return $services;
    }

    /**
     * 
     * 
     */
    public function showQuestions($service){
        $service = Service::findOrFail($service);
        return $service->questions()->with('answers')->get();
    }

}
