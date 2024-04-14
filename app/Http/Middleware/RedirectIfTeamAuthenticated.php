<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfTeamAuthenticated
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
       if (Auth::guard()->check()) {
          return redirect('/home');
      }

      //If request comes from logged in seller, he will
      //be redirected to seller's home page.
      if (Auth::guard('team')->check()) {
          return redirect('/home');
      }
		
		return $next($request);
    }
}
