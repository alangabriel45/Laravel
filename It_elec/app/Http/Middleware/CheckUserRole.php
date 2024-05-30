<?php

namespace App\Http\Middleware;

use App\Models\MultiRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userId = Auth::id();
        $userRoles = MultiRole::where('userId', $userId)->pluck('roleName')->toArray();

        if((in_array('1', $userRoles) && in_array('2', $userRoles)))
        {
            return $next($request);
        }

        abort(401);
    }
}

