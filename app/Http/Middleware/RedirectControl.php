<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectControl
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
            in_array($request->url(),config('redirects.451'))
        ) {
            abort(410);
        }
        return $next($request);
    }
}
