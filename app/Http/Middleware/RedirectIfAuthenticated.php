<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
       switch ($guard){
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    if (auth('admin')->user()->id == 1 || auth('admin')->user()->is_admin == 1 ) {
                        return redirect('admin/dashboard');
                    }
                    return redirect('admin/my-dashboard');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::HOME);
                }
                break;
        }
        return $next($request);
    }
}
