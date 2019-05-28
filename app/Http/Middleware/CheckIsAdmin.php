<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user() || $request->user()->is_admin == 0) {
            return abort(403, "Sorry ! No permissions here");
        }

        return $next($request);
    }
}
