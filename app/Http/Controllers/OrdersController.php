<?php

namespace App\Http\Controllers;

use App\Order;
use App\Quote;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function orderQuote($quoteId){
        $quote = Quote::findOrFail($quoteId);
        $order = Order::create([
            'status' => 'In Progress',
            'amount' => $quote->quote,
            'service_provider_id' => $quote->service_provider_id,
            'customer_id' => $quote->customer_id,
            'project_id' => $quote->project_id
        ]);
        return redirect('/orders/'. $order->id);
    }



    /**
     * 
     * 
     */
    public function index(){
        $orders = auth()->user()->customer_orders;
        return view('orders.index')->withOrders($orders);
    }

     
    /**
     * 
     * 
     */
    public function show($order){
        $order = Order::findOrFail($order);
        return view('orders.show')->withOrder($order);
    }



    /**
     * 
     * 
     */
    public function serviceProviderOrders(){
        $orders = auth()->user()->service_provider_orders;
        return view('orders.service-provider-orders')->withOrders($orders);
    }

    /**
     *  single order for service provide
     */
    public function showServiceProviderOrder($order){
        $order = Order::findOrFail($order);
        return view('orders.show-service-provider-order')->withOrder($order);
    }

    /**
     * 
     * 
     */
    public function markComplete(Request $request, $orderId){
        $request->validate([
            'rating' => 'required',
            'review' => 'required'
        ]);
        $order = Order::findOrFail($orderId);
        $order->status = 'Completed';
        $order->save();
       
        $review = Review::create([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);
        $review->customer()->associate(auth()->user()->id);
        $review->service_provider()->associate($order->service_provider_id);
        $review->save();

        $serviceProvider = User::findOrFail($order->service_provider_id);
        
        $reviews = $serviceProvider->serviceProviderReviews;

        $totalRating =  $reviews->pluck('rating')->sum();
        $reviewsCount = $reviews->count();

        $serviceProvider->rating = $totalRating / $reviewsCount;
        $serviceProvider->save();

        $serviceProvider->notifications()->create([
            'data' => [
                'message' => 'Order for ' . auth()->user()->name . ' Completed',
                'type' => 3,
                'order_id' => $order->id
            ]
        ]);
        $serviceProvider->notifications()->create([
            'data' => [
                'message' => 'Received new review from ' . auth()->user()->name,
                'type' => 4,
                'review_id' => $review->id
            ]
        ]);
            
        Session::flash('success', 'Thanks for leaving a review your order is completed successfully');
        return redirect()->back();
    }


    /**
     * 
     * 
     * mark order  cancel
     */
    public function markCancel(Request $request, $orderId){
        $request->validate([
            'cancellation_reason' => 'required',
        ]);
        $order = Order::findOrFail($orderId);
        $order->status = 'Cancelled';
        $order->cancellation_reason = $request->cancellation_reason;
        $order->save();

        $serviceProvider = User::findOrFail($order->service_provider_id);

        $serviceProvider->notifications()->create([
            'data' => [
                'message' => auth()->user()->name . ' has cancelled an order',
                'type' => 5,
                'order_id' => $order->id
            ]
        ]);

        Session::flash('success', 'Thanks for leaving a review your order is completed successfully');
        return redirect()->back();
    }

}
