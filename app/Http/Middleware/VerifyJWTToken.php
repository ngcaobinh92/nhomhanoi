<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyJWTToken
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
        $this->secretTokenKey = 'SMJNews';

        try {
            $user = JWTAuth::toUser($request->header('Authorization'));
        }catch (JWTException $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Unauthorized - TokenExpired',
                ], $e->getStatusCode());
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Unauthorized - TokenInvalid',
                ], $e->getStatusCode());
            }else{
                return response()->json([
                    'status' => false,
                    'code' => 401,
                    'message' => 'Unauthorized - TokenRequired',
                ]);
            }
        }
        return $next($request);
    }
}
