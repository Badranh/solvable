<?php

namespace App\Http\Middleware;

use Closure;

class hasworkshop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (auth()->user()->workshop != null) {
            return redirect()->route('workshop.view');
        }

        return $next($request);
    }
}
