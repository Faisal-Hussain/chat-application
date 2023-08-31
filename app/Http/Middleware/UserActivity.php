<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserActivity
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
        if (Auth::check()) {
            $expires_after = Carbon::now()->addMinutes(30);
            Cache::put('user-online' . Auth::id(), true, $expires_after);

            if (Auth::user()->hasRole('admin'))  {
                config()->set('session.lifetime', 525600);
            }else{
                config()->set('session.lifetime', 30);
            }

        }
        return $next($request);
    }
}
