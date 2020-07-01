@extends('layouts.app')

@section('content')

    <div class='col-sm-12'>
        <div class='pull-right'>
            <button class='btn btn-primary' data-target='#new-project' data-toggle='modal'>New Project</button>
        </div>
        <table class='table'>
            <thead>
                <tr>
                    <th> Name </th>
                    <th> Action </th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td> <a href='/projects/{{$project->id}}/tasks'}}>{{$project->name}} </a></td>
                        <td>
                            <a href='/projects/{{$project->id}}/edit' class='i'>Edit </a>
                            <form style="display: inline" method="POST"
                                    action="/projects/{{$project->id}}"
                                    accept-charset='UTF-8' class='form-inline'>
                                  <input name="_method" type="hidden" value='DELETE'>
                                  {!! csrf_field() !!}
                                  <button class="btn btn-raised btn-xs btn-danger btn-tiny"
                                          type="submit">
                                    Delete
                                  </button>
                              </form>

                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>

    <div class='modal' id='new-project'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form action='/projects' method="post">
                    {!! csrf_field() !!}
                    <input type='hidden' name="_method" value='post' >
                <div class='modal-header'>
                    <div class='modal-title'>
                        New Project
                    </div>
                </div>
                <div class='modal-body'>
                    <div class='form-group'>
                        <label> Project Name </label> 
                        <input name='name' class='form-control' placeholder="Project Name" required>
                    </div>
                </div>

                <div class='modal-footer'>
                    <button class='btn btn-default' data-dismiss='modal'>Cancel </button>
                    <button class='btn btn-success' type='submit'>Submit</button>
                </div>
            </div>
        </div>
    </div>

@stop