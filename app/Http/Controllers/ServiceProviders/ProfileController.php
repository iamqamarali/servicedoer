<?php

namespace App\Http\Controllers\Serviceproviders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user-type:service-provider');
    }


    /**
     * 
     * 
     */
    public function completeProfile(Request $request){
        $request->validate([
            'profile_pic' => 'required|file',
            'city' => 'required|exists:cities,_id',
            'service' => 'required|exists:services,_id',
            'bio' => 'required',
            'phone' => 'required|numeric',
            'address' => 'sometimes',
        ]);

        $path = '/profile-pic-avatar.png';
        if($request->profile_pic){
            $path = $request->profile_pic->store('profile_images');
        }
        $request->validate([
            'answers' => 'required'
        ]);

        $user = auth()->user();
        $user->fill([
            'profile_image' => Storage::disk('public')->url($path),
            'city_id' => $request->city,
            'service_id' => $request->service,
            'bio' => $request->bio,
            'phone' => $request->phone,
            'address' => $request->address,
            'question_answers' => json_decode($request->question_answers, true)
        ]);
        $user->answers()->sync($request->answers);
        $user->incomplete_profile_step = 2 ;
        $user->save();

        return redirect('/complete-profile/step3');
    }
    
}
