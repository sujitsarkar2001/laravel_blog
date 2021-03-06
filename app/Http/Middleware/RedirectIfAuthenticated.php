<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        if(Auth::guard()->check() && Auth::user()->role->id == 1){
            return Redirect()->route('admin.dashboard');
        }elseif(Auth::guard()->check() && Auth::user()->role->id == 2){
            return Redirect()->route('author.dashboard');
        }else{
            return $next($request);
        }
    }
}
