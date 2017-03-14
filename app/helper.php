<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/3/2
 * Time: 19:48
 */
function TaskCountArray($projects)
{
    $counts = [];
    foreach($projects as $project)
    {
        $perCount = $project->tasks->count();
        array_push($counts,$perCount);
    }
    return $counts;

}

function rand_color()
{
    $R = rand(0,255);
    $G = rand(0,255);
    $B = rand(0,255);
    return 'rgba('.$R .','.$G.','.$B.',0.5)';
}

function permCheck($perm,$role)
{
    return $role->hasPermission($perm->name)?true:false;

}

function roleCheck($role,$user)
{
    return $user->hasRole($role->name)?true:false;

}

function protect_default_admin($role,$user)
{
    if($role->is_admin() && $user->is_admin())
    {
        return 'disabled';
    }
}