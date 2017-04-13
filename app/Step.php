<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
      'name','completed'
    ];
    public function tasks()
    {
        return $this->belongsTo('App\Task');
    }

    public function getCompletedAttribute($value)
    {
        if($value)
        {
            return $this->completed = true;
        }

        return $this->completed = false;
    }
}
