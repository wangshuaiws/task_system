<?php

namespace App\Http\Controllers;

use App\Step;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;

class StepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Task::findOrFail($id)->steps;
        return $data;
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
    public function store($taskID,Request $request)
    {
        Task::findOrFail($taskID)->steps()->create([
            'name' => $request->name,
            'comlpeted' => 0
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function update(Request $request,$taskID,$id)
    {
        $step = Step::findOrFail($id);
        $step->completed = $request->opposite ? 1 : 0;
        $step->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($taskID,$id)
    {
        Step::findOrFail($id)->delete();
    }

    public function completed($taskID)
    {
        Task::findOrFail($taskID)->steps()->update([
           'completed' => 1
        ]);
    }

    public function clear($taskID)
    {
        Step::where('task_id',$taskID)->where('completed',1)->delete();
    }

}
