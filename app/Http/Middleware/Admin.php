<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
       if(auth()->user()){
         if(auth()->user()->permission == 'admin'){
           return $next($request);
         }else {
           return redirect('home')->with('error','You have not admin access');
         }
       } else {
         return redirect('home');
       }
       // if(auth()->user()->isAdmin == 'admin'){
       //   return $next($request);
       // }
       // return redirect(‘home’)->with(‘error’,’You have not admin access’);
     }
}
