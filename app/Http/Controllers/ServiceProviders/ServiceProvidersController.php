<?php

namespace App\Http\Controllers\ServiceProviders;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ServiceProvidersController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param City {$city_id} 
     * @param Service {$service_id}
     */
    public function search(Request $request, $city, $service){
        $service_providers = User::where('city_id', $city)
                                    ->where('service_ids', $service)
                                    ->paginate(20);
        return $service_providers;
    }

}
