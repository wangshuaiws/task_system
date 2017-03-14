<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class ProtectAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('roles');
        $role = Role::findOrFail($id);
        if($role->name !== 'admin'){
            return $next($request);
        }

        return redirect()->back();
    }
}
