<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;

class IsAdmin
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
        if (auth()->user()->role == RoleEnum::ADMIN)
            return $next($request);
        return redirect('/')->withErrors(Lang::get('permission.permission_failed'));
    }
}
