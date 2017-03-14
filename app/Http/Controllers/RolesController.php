<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
        $this->middleware('permission:edit_role',['only' => 'update']);
        $this->middleware(['permission:delete_role','protect.admin.role'],['only' => 'destroy']);
    }

    public function index()
    {
        $roles = Role::with('perms')->get();
        $perms = Permission::get();
        return view('auth.roles.index',compact('roles','perms'));
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        if($request->perm){
            $role->attachPermissions($request->perm);
        }

        return redirect()->back();

    }

    public function update(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        if($role->name !=='admin'){
            $role->name = $request->name;
        }
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $role->savePermissions($request->perm);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        //dd($role);

        return redirect()->back();
    }
}
