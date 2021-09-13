<div class="pop-model">
    <div class="modal fade" id="addCustomer" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Users</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['CustomersController@store'],'method' => 'POST','enctype'=>'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {{Form::label('Full Name')}}
                        {{Form::text('name','',['class'=>'form-control'])}}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email','E-Mail *') !!}
                        {!! Form::text('email',old('email'),['class'=>'form-control']) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                        {!! Form::label('phone_no','Phone *') !!}
                        {!! Form::text('phone_no',old('phone_no'),['class'=>'form-control']) !!}
                        @if ($errors->has('phone_no'))
                            <span class="help-block">
                                {{ $errors->first('phone_no') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('address_1') ? ' has-error' : '' }}">
                        {!! Form::label('address_1','Address 2 *') !!}
                        {!! Form::text('address_1',old('address_1'),['class'=>'form-control']) !!}
                        @if ($errors->has('address_1'))
                            <span class="help-block">
                                {{ $errors->first('address_1') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('address_2') ? ' has-error' : '' }}">
                        {!! Form::label('address_2','Address 2 *') !!}
                        {!! Form::text('address_2',old('address_2'),['class'=>'form-control']) !!}
                        @if ($errors->has('address_2'))
                            <span class="help-block">
                                {{ $errors->first('address_2') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        {!! Form::label('image','Image *') !!}
                        {!! Form::file('image', ['class'=> 'form-control']) !!}

                        @if ($errors->has('image'))
                            <span class="help-block">
                                {{ $errors->first('image') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {!! Form::label('status','Status *') !!}

                        {!! Form::select('status',['1' => 'Active','0' => 'In-Active'], null,
                        ['class'=>'form-control']); !!}

                        @if ($errors->has('status'))
                            <span class="help-block">
                                {{ $errors->first('status') }}
                            </span>
                        @endif
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
