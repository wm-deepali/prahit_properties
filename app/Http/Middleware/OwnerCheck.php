<?php

namespace App\Http\Middleware;

use Closure;

class OwnerCheck
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
        if(\Auth::user()->role == 'owner') {
            return $next($request);
        }
        \Auth::logout();
        \Session::flush();
        return redirect('/')->with('alert-warning', 'Unauthorised Access.');
    }
}
