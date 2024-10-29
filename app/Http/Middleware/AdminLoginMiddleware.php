<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
        if(Auth::check())
        {
            $user = Auth::user();
            if ($user->role < 5) {
                view()->share('adminLogin', Auth::user());
                return $next($request);
            } else {
                return redirect('cms/login');
            }
        } else {
            return redirect('cms/login');
        }
    }
}
