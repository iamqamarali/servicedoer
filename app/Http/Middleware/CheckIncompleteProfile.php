<?php

namespace App\Http\Middleware;

use Closure;

class CheckIncompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()){
            if(auth()->user()->type == 'service-provider'){
                if(auth()->user()->incomplete_profile){
                    if(auth()->user()->incomplete_profile_step == 1){
                        return redirect('/complete-profile/step2');
                    }
                    else if(auth()->user()->incomplete_profile_step == 2){
                        return redirect('/complete-profile/step3');
                    }
                }
            }

            if(auth()->user()->type == 'customer'){
                if(auth()->user()->incomplete_profile){
                    return redirect('/customer/complete-profile/step2');
                }
            }
        }
        return $next($request);
    }
}
