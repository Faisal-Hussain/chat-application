<?php

namespace App\Http\Controllers\Auth;

use App\Events\IsOnline;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Services\CountryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AuthUserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function registration()
    {
        $countries = Country::query()->orderBy('name', 'asc')->get()->toArray();
        $ages = [];
        for($i=18; $i <= 99; $i++ ) {
            $ages[]=$i;
        }
        $clientIP = $this->getIp();
        $currentCountry = CountryService::getCurrentCountry($clientIP);
        return view('auth.register', compact('countries', 'ages', 'currentCountry'));
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'nick_name' => 'required',
        ]);


        $user = User::query()->where('nick_name', $request->nick_name)->first();
        if(! $user) {
            return redirect("login")->withError('Oppes! You have not an account!');
        }

        if ($user->blocked == 1) {
            return redirect("login")->withError('Oppes! Your account is blocked!');
        }


        if (Cache::has('user-online' . $user->id)) {
            return redirect("login")->withError('Oppes! You can not sign in!');
        }


        Auth::loginUsingId($user->id);
        $expires_after = Carbon::now()->addMinutes(30);
        Cache::put('user-online' . $user->id, true, $expires_after);
        broadcast(new IsOnline());
        return redirect()->intended('home')->withSuccess('You have Successfully loggedin');
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'nick_name' => ['required', 'string', 'max:255','unique:users'],
            'age' => ['required', 'string', 'max:2'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);
        $data = $request->all();
        $data['password'] = Hash::make('a6sd12a6s1d');
        $user = $this->create($data);

        $role = Role::query()->where('name', 'basic')->get();
        $user->assignRole($role);

        Auth::loginUsingId($user->id);
        $expires_after = Carbon::now()->addMinutes(30);
        Cache::put('user-online' . $user->id, true, $expires_after);
        broadcast(new IsOnline());
        return redirect()->route('home')->withSuccess('Great! You have Successfully loggedin');
    }



    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return User::query()->create([
            'nick_name' => $data['nick_name'],
            'age' => $data['age'],
            'country_id' => $data['country'],
            'state' => $data['state'],
            'gender' => (integer) $data['gender'],
            'password' => Hash::make($data['password']),
        ]);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        Cache::forget('user-online' . Auth::id());
        broadcast(new IsOnline());
        Session::flush();
        Auth::logout();
        return Redirect()->route('register');
    }

    /**
     * @return null|string
     */
    public function getIp()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $clientIp = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $clientIp = $forward;
        } else {
            $clientIp = $remote;
        }

        return $clientIp;
    }
}
