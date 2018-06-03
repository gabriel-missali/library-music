<?php

namespace App\Http\Middleware;

use Closure;

class User
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
        if(auth()->user()->permission == 'user' || auth()->user()->permission == 'admin'){
          return $next($request);
        }else {
          return redirect('home')->with('error','You have not user access');
        }
      } else {
        return redirect('home');
      }
    }
}
