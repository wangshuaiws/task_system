<?php
namespace App\Repository;

use App\Task;
use Auth;

class TasksRepository
{
    /*public function __construct()
    {
        $this->middleware('isnow');
    }
*/
    public function total()
    {
        //$total = Task::count();
        if(Auth::user()){
            $total = Auth::user()->tasks()->count();
            return $total;
        }
    }

    public function  doneCount()
    {
        //$doneCount = Task::where('completed',1)->count();
        if(Auth::user()) {
            $doneCount = Auth::user()->tasks()->where('completed', 1)->count();
            return $doneCount;
        }
    }

    public function  toDoCount()
    {
        //$toDoCount = Task::where('completed',0)->count();
        if(Auth::user()) {
            $toDoCount = Auth::user()->tasks()->where('completed', 0)->count();
            return $toDoCount;
        }
    }
}