<?php

namespace App\Http\Controllers;

use App\Project;
use App\Repository\TasksRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use Auth;
use App\Http\Requests\checkProjectRequest;
use App\Http\Requests\updateProjectRequest;
use Illuminate\Support\Facades\Redirect;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $tasks;
    public function __construct(TasksRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }


    public function index()
    {
        $toDo = Auth::user()->tasks()->where('completed',0)->paginate(15);
        $Done = Auth::user()->tasks()->where('completed',1)->paginate(15);
        $projects = Project::lists('name','id');
        return view('tasks.index',compact('toDo','Done','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(checkProjectRequest $request)
    {
        Task::create([
           'title' => $request->name,
            'project_id' => $request->project
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tasks/details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateProjectRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->project_id = $request->projectList;
        $task->save();
        return Redirect::back();
    }

    public function check($id)
    {
        $task = Task::findOrFail($id);
        $task->completed = 1;
        $task->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return Redirect::back();
    }

    public function charts()
    {
        $total = $this->tasks->total();
        $toDoCount = $this->tasks->toDoCount();
        $DoneCount = $this->tasks->doneCount();
        $projects = Project::with('tasks')->get();
        $names = Project::lists('name');
        return view('tasks/charts',compact('total','toDoCount','DoneCount','names','projects'));
    }
}
