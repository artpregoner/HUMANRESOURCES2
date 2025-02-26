<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Authorization') !== 'Bearer ' . config('1|0qHzOZokGWCYs3nzJfXDYXHT3HQWwxCLCvj2vn06cc076ff3')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
