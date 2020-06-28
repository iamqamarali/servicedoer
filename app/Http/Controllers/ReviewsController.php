<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'type:customer'])->except(['index', 'showApi']);
        $this->middleware(['auth:api'])->except(['showApi']);
    }


    /**
     * 
     * fetch reviews of service provider
     */ 
    public function index($serviceProvider){
        $serviceProvider = User::findOrFail($serviceProvider);
        $reviews = $serviceProvider->serviceProviderReviews()->latest()->paginate(15);
        return $reviews;
    }


 
    /**
     * 
     * store review by customer
     */
    public function store(Request $request, $service_provider){
        $request->validate([
            'review' => 'required',
            'rating' => 'required,numeric'
        ]);
        
        if(!User::where('type', 'service-provider')
                ->where('_id', $service_provider)->first())
        {
            return "Service provider not found"; 
        }
        
        $review = Review::create([
            'review' => $request->review,
            'rating' => $request->rating,
            'customer_id' => auth()->user()->id,
            'service_provider_id' => $service_provider
        ]);

        return $review;
    }



    public function showApi($review){
        return  Review::with('customer')->with('service_provider')->findOrFail($review);        
    }

}
