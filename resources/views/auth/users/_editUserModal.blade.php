<!-- Button trigger modal -->
<button type="button" class="role-btn btn btn-sm pull-right" data-toggle="modal" data-target="#editRoleModal-{{ $user->id }}">
    <i class="fa fa-cog"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editRoleModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editRoleModal-{{ $user->id }}-Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editRoleModal-{{ $user->id }}-Label">编辑用户</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'patch','route'=>['admin.users.update',$user->id]]) !!}
                <div class="checkbox">
                    @foreach($roles as $role)
                        <label>
                            {!! Form::checkbox('role[]',$role->id,roleCheck($role,$user),[protect_default_admin($role,$user)]) !!}
                            {{ $role->display_name or $role->name }}
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                {!! Form::submit('编辑用户',['class'=>"btn btn-default"]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>