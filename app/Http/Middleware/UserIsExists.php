<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class UserIsExists
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Cache::remember('users_' . $request['user'], env('CACHE_LIFETIME'), function () use($request){
            $user = User::where('name', $request['user'])->first();
            if(!$user) {
                abort(404);
            }
            return $user;
        });

        return $next($request);
    }
}
