<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Project; 
use App\Model\Task;

class ProjectController extends Controller
{
    //
    public function index(){
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function store(){
        Project::create(['name'=>request()->name]);
        return redirect()->back()->with('message', 'Project Created Successfully!');
    }

    public function tasks($project_id){
        $tasks = Task::where(['project_id'=>$project_id])->get();
        $project = Project::find($project_id);
        return view('projects.tasks', compact('project', 'tasks'));
    }

    public function edit($id){
        $project = Project::find($id);
        return view('projects.edit', compact('project'));
    }

    public function update($id){
        Project::where(['id'=>$id])->update(request()->only(['name']));
        return redirect()->back()->with('message', 'Project Updated Successfully');
    }

    public function destroy($id){
        Project::where(['id'=>$id])->delete(); 
        Task::where(['project_id'=>$id])->delete();
        return redirect()->back()->with('message', 'Project Deleted Successfully!'); 
    }

}
