<div class="pop-model">
    <div class="modal fade" id="addbrand" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['SupplierController@store'],'method' => 'POST' ]) !!}
                    <div class="form-group">
                        {{Form::label('Supplier Name')}}
                        {{Form::text('supplier_name','',['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('Contact No')}}
                        {{Form::text('contact_no','',['class'=>'form-control'])}}
                    </div>
                    {{Form::submit('Create',['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>                                  
    </div>
</div>