<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->status == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Tài khoản của bạn không hoạt động.');
            }
        }
        return redirect()->route('login');
    }
}