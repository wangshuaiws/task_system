{!! Form::open(['route'=>['projects.destroy',$project->id],'method'=>'delete']) !!}
<button type="submit" class="btn">
    <i class="fa fa-btn fa-close"></i>
</button>
{!! Form::close() !!}
