<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function Form(Request $request){
        $user=null;
        if($request->id !='' && $request->has('id')){
            $user=User::find($request->id);
        }
        $countries = Country::query()->orderBy('name', 'asc')->get()->toArray();
        $ages = [];
        for($i=18; $i <= 99; $i++ ) {
            $ages[]=$i;
        }

        return view('admin.users.form',['user'=>$user,'ages'=>$ages,'countries'=>$countries]);
    }
}
