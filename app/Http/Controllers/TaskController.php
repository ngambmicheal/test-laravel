<?php

namespace App\Http\Controllers;

use App\Model\Task;
use App\Model\Project;
use Illuminate\Http\Request;
use App\Repositories\ProjectRepository;

class TaskController extends Controller
{
    //

    public $projectRepos; 
    public $taskRepos; 

    public function __construct( ProjectRepository $projectRepos)
    {
        $this->projectRepos = $projectRepos; 
    }

    public function index(){
        $tasks = Task::orderBy('priority', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(){
        $task = Task::create(request()->all()); 
        $task->priority = $task->id; 
        $task->save(); 
        return redirect()->back()->with('message', 'Task Created Successfully');
    }

    public function edit($id){
        $task = Task::find($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update($id){
        Task::where(['id'=>$id])->update(request()->only(['project_id', 'name']));
        return redirect()->back()->with('message', 'Task Updated Successfully');
    }

    /**
     * Get List of Projects in option tag form
     */
    public function getProjects(){
        return $this->projectRepos->getProjects('html');
    }

    public function updatePriority($id){
        $task = Task::find($id);

        $priority = request()->priority;
        $old = Task::where(['priority'=>$priority])->first();
        $old->priority = $task->priority;
        $old->save(); 

        $task->priority = $priority;
        $task->save();
    }

    public function destroy($id){
        Task::where(['id'=>$id])->delete(); 
        return redirect()->back()->with('message', 'Task Deleted Successfully!'); 
    }
}
