<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KonseliMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::find($request->session()->get('userId'));
        if($user->role == "konseli"){
            if(request()->is('pin')){
                if(session()->has('pin')){
                    return redirect('/dashboard');
                }else{
                    return $next($request);
                }
            }
            if(!request()->is('pin')){
                if(session()->has('pin')){
                    return $next($request);
                }else{
                    return redirect('/pin');
                }
            }

            // if(Hash::check('siko', $user->password)){
            //     if($request->is('pin')){
            //         return $next($request);
            //     }
            //     return redirect('/pin');
            // }else{
            //     return redirect('/dashboard');
            // }
        }
        return $next($request);
    }
}
