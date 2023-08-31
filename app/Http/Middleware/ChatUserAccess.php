<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatUserAccess
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
        $id = $request->id;
        if (Auth::check() and  $id) {
            if(Auth::user()->roles[0]['name'] == 'admin') {
                return $next($request);
            }
            $check = \App\Models\BlockUser::query()
                ->where('from_id', Auth::id())
                ->where('to_id', $id)
                ->orWhere(function ($q) use($id) {
                    $q->where('from_id', $id)->where('to_id', Auth::id());
                })->first();

            if(!$check) {
                return $next($request);
            }

        }
        return redirect()->route('home');
    }
}
