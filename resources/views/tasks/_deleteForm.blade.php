{!! Form::open(['route'=>['tasks.destroy',$task->id],'method'=>'delete']) !!}
<button type="submit" class="btn-danger btn-sm">
    <i class="fa fa-close"></i>
</button>
{!! Form::close() !!}
