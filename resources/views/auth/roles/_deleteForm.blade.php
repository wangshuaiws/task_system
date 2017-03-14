{!! Form::open(['method'=>'delete','route'=>['admin.roles.destroy',$role->id]]) !!}


<button type="submit" class="role-btn btn btn-sm pull-right">
    <i class="fa fa-btn fa-close"></i>
</button>

{!! Form::close() !!}