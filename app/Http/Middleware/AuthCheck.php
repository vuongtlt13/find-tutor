<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (Sentinel::check()) {
                return $next($request);
            } else {
                return redirect(route('login'))->with('login-require', 'fail');
            }
        } catch (NotActivatedException $ex) {
            Sentinel::logout();
            return redirect(route('login'))->with('login-require', 'fail');
        }
    }
}
