<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Config;

class TrailingSlashes
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
    if (preg_match('/[\W]#\/|%3C|%3E/', $request->getRequestUri()))
    {
      return abort(404);
    }
    return $next($request);
  }
}