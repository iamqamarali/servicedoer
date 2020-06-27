<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\SubscriptionPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function subscribe(Request $request, $package){
        $package = SubscriptionPackage::findOrFail($package);
        $user = auth()->user();
        $subscription = Subscription::create([
            'status' => 'active',
            'package_id' => $package->id,
            'trial_till_date' => Carbon::now()->addDays($package->trial_days)->toDateString()
        ]);
        $subscription->service_provider()->associate($user);
        $user->connects = $user->connects + $package->connects; 
        $user->save(); 
        $user->unset('incomplete_profile');
        $user->unset('incomplete_profile_step');

        return redirect()->route('service-provider.profile', $user->id);
    }


}
