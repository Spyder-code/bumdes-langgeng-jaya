<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        // Change this condition as per your requirement.
        if ( Auth::check() && Auth::user()->name === 'owner' ) {
            return $next($request);
        } else {
            return redirect('login2');
        }
        
    }
}
