@extends('layouts.app')
@section('customHeader')
    <meta name="token" id="token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div id="app" class="container">
        <h1 id="text-muted">{{ $task->title }}</h1>

        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 v-show="remaings.length">待完成的步骤(@{{remaings.length }})
                        <span class="btn btn-sm btn-info pull-right" @click="CompleteAll">完成所有任务</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="step in steps | inProcess">
                            <span @dblclick="editStep(step)">@{{ step.name  }}</span>
                        <span class="pull-right">
                        <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                            <i class="fa fa-close" @click="removeStep(step)"></i>
                        </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <form @submit.prevent="addStep" class="form-inline form-inline-fullwidth">
                        <div class="form-group">
                            <input type="text" v-model="newStep" v-el:newstep class="form-control" placeholder="I need to">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">添加步骤</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="clearfix"></div>-->
        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 v-show="completions.length">已完成的步骤(@{{ completions.length }})
                        <span class="btn btn-sm btn-danger pull-right" @click="clearCompletion">清除所有已完成的</span>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="step in steps | doneProcess">@{{ step.name  }}
                            <div class="pull-right">
                                <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                                <i class="fa fa-close" @click="removeStep(step)"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- <pre>@{{ $data | json }}</pre>--}}
    </div>


@endsection



@section('customJS')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection




