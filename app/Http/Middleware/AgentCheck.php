<?php

namespace App\Http\Middleware;

use Closure;

class AgentCheck
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
        if(\Auth::user()->role == 'agent') {
            return $next($request);
        }
        \Auth::logout();
        \Session::flush();
        return redirect('/')->with('alert-warning', 'Unauthorised Access.');
    }
}
