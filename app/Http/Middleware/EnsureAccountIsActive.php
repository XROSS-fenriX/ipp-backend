<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || $user->account_status !== 'active') {
            return response()->json([
                'message' => 'Your account is inactive. Please contact support.',
            ], Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
