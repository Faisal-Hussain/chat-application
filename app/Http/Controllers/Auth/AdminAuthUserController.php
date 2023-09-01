<?php

namespace App\Http\Controllers\Auth;

use App\Events\IsOnline;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminAuthUserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.admin.login');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'nick_name' => 'required',
            'password' => 'required',
        ]);


        $user = User::query()->where('nick_name', $request->nick_name)->first();
        if(! $user) {
            return redirect()->route('login.admin')->withError('Oppes! You have not an account!');
        }

        if( !$user->hasRole('admin')) {
            return redirect()->route('login.admin')->withError('Something is wrong!');
        }
        $credentials = $request->only('nick_name', 'password');
        if (Auth::attempt($credentials)) {
            $expires_after = Carbon::now()->addMinutes(30);
            Cache::put('user-online' . $user->id, true, $expires_after);
            broadcast(new IsOnline());
            return redirect()->route('dashboard')->withSuccess('You have Successfully loggedin');
        }

        return redirect()->route('login.admin')->withError('Something is wrong!');
    }

}
