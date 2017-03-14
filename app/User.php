<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
	use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	protected $admin = '1473949341@qq.com';

	public function is_admin()
	{
		return $this->email == $this->admin?true:false;
	}
	
	public function project(){
		return $this->hasMany('App\Project');
	}
	
	public function tasks(){
		return $this->hasManyThrough('App\Task','App\Project');
	}
}
