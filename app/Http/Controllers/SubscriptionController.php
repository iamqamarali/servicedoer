<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\SubscriptionPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{

    public function subscribe(Request $request){
        $request->validate([
            'package' => 'required',
            'stripeToken' => 'required'            
        ]);
        $package = SubscriptionPackage::findOrFail($request->package);


        \Stripe\Stripe::setApiKey('sk_test_BDFXoH172rqPJavwxCm4h3ZL00BcXypMVY');

        // Token is created using Stripe Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->stripeToken;
        $charge = \Stripe\Charge::create([
          'amount' => $package->price . '00',
          'currency' => 'PKR',
          'description' => 'Subscription from service provider',
          'source' => $token,
        ]);

        $user = auth()->user();
        $subscription = Subscription::create([
            'status' => 'active',
            'package_id' => $package->id,
            'trial_till_date' => Carbon::now()->addDays($package->trial_days)->toDateString(),
            'stripe_charge_id' => $charge->id
        ]);
        $subscription->service_provider()->associate($user);
        $user->connects = $user->connects + $package->connects; 
        $user->save(); 
        $user->unset('incomplete_profile');
        $user->unset('incomplete_profile_step');

        Session::flash('success',  "You've been successfully subscribed to " . $package->name . ". You can now get quote requests from customers" );

        return redirect()->route('service-provider.profile', $user->id);
    }


}
