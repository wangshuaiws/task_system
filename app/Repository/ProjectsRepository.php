<?php
namespace App\Repository;

use Illuminate\Support\Facades\Redirect;
use Image;
use App\Project;


class ProjectsRepository
{
    public function newProject($request)
    {
        $request->user()->project()->create([
            'name' => $request->name,
            'thumbnail' => $this->thumbnail($request)
        ]);

        //return Redirect::back();
        //return "创建成功";
    }

    public function thumbnail($request)
    {
        if($request->hasFile('thumbnail'))
        {
            $file = $request->thumbnail;
            $name = str_random(10) . '.jpg';
            $path = public_path() . '/thumbnails/' . $name;
            Image::make($file)->resize(261,200)->save($path);

            return $name;
        }

    }

    public function updateProject($request,$id)
    {
        $project = Project::findOrFail($id);
        $project->name = $request->name;
        if($request->hasFile('thumbnail'))
        {
            $project->thumbnail = $this->thumbnail($request);
        }

        $project->save();

    }
}