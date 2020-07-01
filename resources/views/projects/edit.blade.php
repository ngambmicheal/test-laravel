@extends('layouts.app')

@section('content')
    <div class=''>
            <form action='/projects/{{$project->id}}' method="post">
                    {!! csrf_field() !!}
                    <input type='hidden' name="_method" value='put' >
                <div class='modal-header'>
                    <div class='modal-title'>
                        Edit Project
                    </div>
                </div>
                <div class='modal-body'>
                    <div class='form-group'>
                        <label> Project Name </label> 
                        <input name='name' class='form-control' placeholder="Project Name" required value='{{$project->name}}'> 
                    </div>

                </div>

                <div class='modal-footer'>
                    <button class='btn btn-success' type='submit'>Save</button>
                </div>
            </form>
    </div>
@stop