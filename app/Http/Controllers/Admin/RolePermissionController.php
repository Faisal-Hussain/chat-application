<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    //
    public function Roles(Request $request){
        $roles=Role::latest()->paginate(50);
        return view('admin.roles_permission.roles',['roles'=>$roles]);
    }

    public function Save(Request $request){
        $request->validate(['name'=>'required']);
        $role=Role::where('id',$request->id)->firstOrNew();
        $role->name=$request->name;
        $role->save();
        return back()->with('success','Role has been deleted!');
    }

    public function Delete(Request $request){
        $request->validate(['id'=>'required']);
        $role=Role::find($request->id);
        $role->delete();
        return response()->json(['status'=>1]);
    }

}
