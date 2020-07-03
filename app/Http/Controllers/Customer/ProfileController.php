<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function customerCompleteProfileStep2(){
        return view('customer.complete-profile.step2');
    }

    public function customerProfile($customer){
        $customer = User::findOrFail($customer);
        return view('customer.profile')
                ->withOrders($customer->customer_orders()->where('status', 'Completed')->get())
                ->withCustomer($customer);
    }


    public function completeProfile(Request $request){
        $request->validate([
            'profile_pic' => 'required|file',
            'city' => 'required|exists:cities,_id',
            'bio' => 'required',
            'phone' => 'required|numeric',
            'address' => 'sometimes',
        ]);
        $path = '/profile-pic-avatar.png';
        if($request->profile_pic){
            $path = $request->profile_pic->store('profile_images');
        }

        $user = auth()->user();
        $user->fill([
            'profile_image' => Storage::disk('public')->url($path),
            'city_id' => $request->city,
            'bio' => $request->bio,
            'phone' => $request->phone,
        ]);
        $user->save();
        $user->unset('incomplete_profile');

        return redirect('/customer/profile/'. $user->id);
    }

}
