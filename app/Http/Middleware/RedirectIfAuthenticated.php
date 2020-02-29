<?php

namespace App\Http\Middleware;

use App\User;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && auth()->user()->is_admin()) {
            // return redirect(RouteServiceProvider::HOME);
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth::guard($guard)->check() && auth()->user()->is_vendor()){
            return redirect()->route('vendor.dashboard');
        }
        else{
            return $next($request);
        }

    }
}
