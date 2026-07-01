<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (Auth::user()->status === 'blocked') {

                Auth::logout();

                return redirect()
                    ->route('login')
                    ->with('error', 'Your account has been blocked by the administrator.');

            }

        }

        return $next($request);
    }
}