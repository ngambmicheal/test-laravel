@extends('layouts.app')

@section('content')


    <div class='col-sm-12'>
        <h3> {{$project->name}} </h3> 

        <div class='pull-right'>
            <button class='btn btn-info' data-target='#new-task' data-toggle='modal'>New Task</button>
        </div>
     <div class='row'>
        <table class='table table-hovered' id='sortable'>
            <thead>
                <tr>
                    <th> Name </th>
                    <th> Project </th>
                    <th> Created On </th>
                    <th> Action </th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)
                    <tr data-priority='{{$task->priority}}' id='{{$task->id}}'>
                        <td> {{$task->name}} 
                        <td> {{$task->project->name}} </td>
                        <td> {{$task->created_at->format(' jS M Y , h:i A')}} </td>
                        <td>
                            <a href='/tasks/{{$task->id}}/edit' class='i'>Edit </a>
                            <form style="display: inline" method="POST"
                                    action="/tasks/{{$task->id}}"
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
    </div>

    <div class='modal' id='new-task'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <form action='/tasks' method="post">
                    {!! csrf_field() !!}
                    <input type='hidden' name="_method" value='post' >
                <div class='modal-header'>
                    <div class='modal-title'>
                        New Task
                    </div>
                </div>
                <div class='modal-body'>
                    <div class='form-group'>
                        <label> Project </label> 
                        <select id ='projects' name='project_id' class='form-control' placeholder="Project Name" required>
                            <option value="{{$project->id}}"> {{$project->name}} </option>
                        </select>
                    </div>
                    <div class='form-group'>
                        <label> Task Name </label> 
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


@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>

    $(document).ready(function(){
        $(function() {
            $("#sortable tbody").sortable({
            cursor: "move",
            placeholder: "sortable-placeholder",
            helper: function(e, tr)
            {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index)
                {
                // Set helper cell sizes to match the original sizes
                $(this).width($originals.eq(index).width());
                });
                return $helper;
            },
            start:function(event, ui){

            },
            stop:function(event, ui){
                position = ui.item.index();
                id  = ui.item.attr('id');
                $.ajax({
                    url:`/tasks/${id}/update-priority`,
                    method:'get',
                    data:{priority:position}
                })
            }
            }).disableSelection();
        });


    })

    </script>
@stop 