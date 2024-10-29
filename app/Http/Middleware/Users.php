<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Users
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
        if(Session::get('users'))
        {
            $user = Session::get('users');
            view()->share('users', $user);
            return $next($request);
        } else {
            return $next($request);
        }
    }
}
