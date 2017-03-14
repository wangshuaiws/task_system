<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;

class PermissionsController extends Controller
{
    public function store(Request $request)
    {
        $perm = Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        return Redirect()->back();

    }
}
