<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class IsLibrarian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isLibrarian() || auth()->user()->isAdmin())
            return $next($request);
        return redirect('/')->withErrors(Lang::get('permission.permission_failed'));
    }
}
