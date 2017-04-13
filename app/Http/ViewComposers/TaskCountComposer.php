<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repository\TasksRepository;
use Auth;
class TaskCountComposer
{
    public function __construct(TasksRepository $task)
    {
        return $this->task = $task;
    }

    public function compose(View $view)
    {
        /*if(Auth::user()){
            $tasks = Auth::user()->tasks()->get()->toArray();
            $view->with('task',$tasks);
        }*/
        //dd($tasks);
        $view->with([
            'total' => $this->task->total(),
            'doneCount' => $this->task->doneCount(),
            'toDoCount' => $this->task->toDoCount(),
        ]);
    }
}