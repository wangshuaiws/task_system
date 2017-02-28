@extends('layouts.app')

@section('content')
    <div class="container tasks-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#toDo" aria-controls="active" role="tab" data-toggle="tab">未完成的任务</a></li>
            <li role="presentation"><a href="#Done" aria-controls="messages" role="tab" data-toggle="tab">已经完成的任务</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="toDo">
                <table class="table table-striped">
                    @foreach($toDo as $task)
                        <tr><td class="first-cell"> {{ $task->title }} </td>
                            <td class="icon-cell">@include('tasks/check')</td>
                            <td class="icon-cell"> @include('tasks/_editForm') </td>
                            <td class="icon-cell">@include('tasks/_deleteForm')</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="Done">
                <table class="table table-striped">
                    @foreach($Done as $task)
                        <tr><td> {{ $task->title }} </td>
                            <td> @include('tasks/check') </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection