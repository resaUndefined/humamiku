<?php

namespace App\Http\Middleware;
// use Auth;
use Closure;

class isAdminMiddleware
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
        if (auth()->user()->role->level == 1) {
            return $next($request);
        }
        return redirect()->route('home')->with('error','You have not admin access');
    }
}
