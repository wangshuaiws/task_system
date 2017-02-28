@if($errors->has('name'))
    <ul class="alert alert-danger">
        @foreach($errors->get('name') as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
{!! Form::open(['route' => ['tasks.store','project' => $project->id],'class'=>'form-inline']) !!}
{!! Form::text('name',null,['placeholder'=>'有什么要完成的任务','class'=>'form-control']) !!}

<button type="submit" class="btn btn-success">
    <i class="fa fa-plus"></i>
</button>

{!! Form::close() !!}