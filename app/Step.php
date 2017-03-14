<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function tasks()
    {
        return $this->belongsTo('App\Task');
    }
}
