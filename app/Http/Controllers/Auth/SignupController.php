<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:api');
    }


    public function signupServiceProvider(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'city' => 'required|exists:cities,_id'
        ]);
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => 'service-provider',
            'incomplete_profile' => true,
            'city_id' => $request->city_id
        ]);
        
        return response()->json([
            'message' => 'User created Successfully',
            'user' => $user
        ]);
    }


    /**
     * 
     * 
     */
    public function signupCustomer(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => 'customer',
        ]);
        
        return response()->json([
            'message' => 'User created Successfully',
            'user' => $user
        ]);
    }


}
