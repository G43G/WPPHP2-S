<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(session()->has('user'))
        {
            $user = session()->get('user')[0];
            
            if($user->role_name == 'administrator')
            {
                return $next($request);
            }
            else
            {
                return redirect('/home');
            }
        }
        else
        {
           return redirect('/home'); 
        }
    }
}
