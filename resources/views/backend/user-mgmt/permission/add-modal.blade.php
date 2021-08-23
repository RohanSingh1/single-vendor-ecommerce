<!-- calls dialog-->
<div class="modal fade" id="addForm" role="dialog">
    <div class="modal-dialog">
        <!-- dialog content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add a Permission</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                {!! Form::open(['action' => ['PermissionsController@store'],'method' => 'POST' ]) !!}
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name','',['class' => 'form-control','placeholder' => 'Name'])}}
                </div>
                {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>