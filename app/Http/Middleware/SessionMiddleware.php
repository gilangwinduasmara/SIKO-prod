<?php


namespace App\Http\Middleware;

use App\User;
use Closure;

class SessionMiddleware
{
    public function handle($request, Closure $next){
        if(!session()->has('userId')){
            return redirect("/");
        }else{
            $user = User::find(session()->get('userId'));
            if($user->role == 'konseli' || $user->role == 'konselor'){
                if($request->is('admin/dashboard')){
                    return redirect('/dashboard');
                }
            }else if($user->role == 'admin'){
                if($request->is('dashboard')){
                    return redirect('/admin/dashboard');
                }
            }
        }
        return $next($request);
    }
}
