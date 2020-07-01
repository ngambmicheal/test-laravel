@extends('layouts.app')

@section('content')
    <div class=''>
            <form action='/tasks/{{$task->id}}' method="post">
                    {!! csrf_field() !!}
                    <input type='hidden' name="_method" value='put' >
                <div class='modal-header'>
                    <div class='modal-title'>
                        Edit Task
                    </div>
                </div>
                <div class='modal-body'>
                    <div class='form-group'>
                        <label> Project </label> 
                        <select id ='projects' name='project_id' class='form-control' placeholder="Project Name" required>
                            @foreach($projects as $project)
                                <option value='{{$project->id}}' {{$project->id==$task->project_id?'selected':''}} >{{$project->name}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class='form-group'>
                        <label> Task Name </label> 
                        <input name='name' class='form-control' placeholder="Task Name" required value='{{$task->name}}'> 
                    </div>

                </div>

                <div class='modal-footer'>
                    <button class='btn btn-success' type='submit'>Save</button>
                </div>
            </form>
    </div>
@stop