<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name','display_name','description'
    ];

    public function is_admin()
    {
        return $this->name == 'admin'?true:false;
    }

}