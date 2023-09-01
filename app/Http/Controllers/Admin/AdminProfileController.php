<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\MF;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //
    public function Profile(){
        $countries = Country::query()->orderBy('name', 'asc')->get()->toArray();
        $ages = [];
        for($i=18; $i <= 99; $i++ ) {
            $ages[]=$i;
        }
        return view('pages.admin.profile.profile',['ages'=>$ages,'countries'=>$countries]);
    }

    public function Update(Request $request){
        $request->validate(['nick_name'=>'required']);
        $user=User::findOrFail(Auth::user()->id);
        if(!Hash::check($request->cpassword,$user->password)){
            return back()->with('error','Incorrect password, please try again later');
        }
        if($request->hasFile('avatar')){
            $user->avatar=MF::Upload($request->file('avatar'));
        }
        if($user->username != $request->username){
            $request->validate(['username'=>'regex:/^[a-zA-Z0-9]*$/']);
        }
        $user->nick_name=$request->nick_name;
        $user->age=$request->age ?? 18;
        $user->gender=$request->gender ?? 1;
        $user->username=$request->username ?? null;
        $user->country_id=$request->country ?? $user->country;
        $user->state=$request->state ?? $user->state;
        if($request->has('password') && $request->password !=''){
            $request->validate(['password'=>'confirmed']);
            $user->password=Hash::make($request->password);
        }
        $user->save();
        Auth::loginUsingId($user->id);
        return back()->with('success','Admin profile has been updated!');
    }
}
