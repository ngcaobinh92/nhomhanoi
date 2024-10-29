<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class LangPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     $language = \Session::get('post_language');
    //     if (Auth::check() == true) {
    //         $user = Auth::user();
    //     } elseif(Session::has('users') == true) {
    //         $user = Session::get('users');
    //     } else {
    //         $user = '';
    //     }
        
    //     if ($user != null) {
    //         view()->share('post_language', $user->lang);
    //         return $next($request);
    //     } else {
    //         if ($language != null) {
    //             view()->share('post_language', $language);
    //             return $next($request);
    //         } else {
    //             view()->share('post_language', 'kr');
    //             return $next($request);
    //         }
    //     }
    // }


    public function handle($request, Closure $next)
    {
        $language = \Session::get('post_language');
        if ($language == null) {
            \Session::put('post_language', 'vn');
            view()->share('post_language', 'vn');
            return $next($request);
        } else {
            \Session::put('post_language', $language);
            view()->share('post_language', $language);
            return $next($request);
        }
        return $next($request);
    }
}
