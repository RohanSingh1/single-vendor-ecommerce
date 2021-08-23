<div class="modal fade" id="addForm" role="dialog">
    <div class="modal-dialog">
        <!-- dialog content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add a Role</h3>
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
            </div>
            <div class="modal-body" >
                {!! Form::open(['action' => ['RolesController@store'],'method' => 'POST' ]) !!}
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name','',['class' => 'form-control','placeholder' => 'Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('permissions', 'Permission')}}
                    <br/>
                    @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                    <br/>
                    @endforeach
                    
                </div>
                {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>