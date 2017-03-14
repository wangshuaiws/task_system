<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repository\TasksRepository;

class TaskCountComposer
{
    public function __construct(TasksRepository $task)
    {
        return $this->task = $task;
    }

    public function compose(View $view)
    {
        $view->with([
            'total' => $this->task->total(),
            'doneCount' => $this->task->doneCount(),
            'toDoCount' => $this->task->toDoCount(),
        ]);
    }
}