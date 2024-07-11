<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserHasSeenIntroVideoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            ! auth()->user()->has_seen_intro_video &&
            config('site.intro_video')
        ) {
            return redirect()->route('user.intro_video');
        }


        return $next($request);
    }
}
