<?php

namespace App\Http\Middleware;

use App\Events\IsOnline;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class BlockUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->blocked == 0)  {
            return $next($request);
        }

        if(Auth::check()) {
            Cache::forget('user-online' . Auth::id());
            broadcast(new IsOnline());
            Session::flush();
            Auth::logout();
        }
        return redirect()->route('login');
    }
}
