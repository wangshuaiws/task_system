<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('roles.perms')->get();
        $roles = Role::get();
        return view('auth.users.index',compact('users','roles'));

    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        if($roleArray = $request->role){
            $user->roles()->sync($roleArray);
        }else{
            $user->roles()->detach();
        }

        if($user->is_admin())
        {
            $admin = Role::where('name','admin')->first();
            $user->attachRole($admin);
        }

        return redirect()->back();
    }
}
