<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTask-{{ $task->id }}">
    <i class="fa fa-cog"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editTask-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="editTaskLabel-{{ $task->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editTaskLabel-{{ $task->id }}">编辑任务</h4>
            </div>
            <div class="modal-body">
                {!! Form::model($task,['route'=>['tasks.update',$task->id],'method'=>'PATCH']) !!}
                <div class="form-group">
                    {!! Form::label('title','任务名称 :',['class'=>'control-label']) !!}
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('projectList','所属项目 :',['class'=>'control-label']) !!}
                    {!! Form::select('projectList',$projects,null,['class'=>'form-control']) !!}
                </div>

                @if($errors->has('title'))
                    <ul class="alert alert-danger">
                        @foreach($errors->get('title') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
                {!! Form::submit('编辑任务',['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>