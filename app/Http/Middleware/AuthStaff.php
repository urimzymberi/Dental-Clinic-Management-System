<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthStaff
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!(Auth::guard('staff')->check()
            && null !== session('Staff_Auth')
            && True === session('Staff_Auth'))) {
            return redirect(route('staff.login'));
        } else {
            return $next($request);
        }
    }
}
