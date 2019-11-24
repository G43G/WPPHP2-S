<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if(session()->has('user'))
        {
            return $next($request);
        }
        else
        {
           return redirect('/home'); 
        }
    }
}
