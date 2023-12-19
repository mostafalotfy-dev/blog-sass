<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppendTokenToResponse
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($user = $request->user()) {
            $user->tokens()->delete();
            $token = $user->createToken("sassproject")->plainTextToken;

            return $response->withCookie(cookie("token", $token, now()->addHours(24)->timestamp,"/",$user->user_name.".".$request->getHost()));
        }
        return $response;
    }
}
