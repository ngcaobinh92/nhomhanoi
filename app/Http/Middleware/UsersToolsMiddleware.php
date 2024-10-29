<?php

namespace App\Http\Middleware;
use DB;
use Closure;
use Illuminate\Support\Facades\Auth;

class UsersToolsMiddleware
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
            $role = DB::table('roles')->where('id', $user->role)->first();
            if ($role->title == 'Admin' || $role->title == 'Manager' || $role->title == 'Employee') {
                view()->share('usersTools', Auth::user());
                return $next($request);
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
