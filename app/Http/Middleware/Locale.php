<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Locale
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
        $language = \Session::get('website_language');
        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config
        // Chuyển ứng dụng sang ngôn ngữ được chọn
        if ($language == null) {
            if(Auth::check())
            {
                \Session::put('website_language', Auth::user()->lang);
                view()->share('website_language', Auth::user()->lang);
                config(['app.locale' => Auth::user()->lang]);
            }
        } else {
            \Session::put('website_language', $language);
            view()->share('website_language', $language);
            config(['app.locale' => $language]);
        }

        return $next($request);
    }
}