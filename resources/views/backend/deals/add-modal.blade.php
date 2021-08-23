<div class="pop-model">
    <div class="modal fade" id="addDeal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Deals</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['DealController@store'],'method' => 'POST','enctype'=>'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {{Form::label('Deal Title')}}
                        {{Form::text('name','',['class'=>'form-control'])}}
                    </div>

                   <div class="form-group">
                        <label for="products">Select Product</label>
                        <div >
                            <select name="products[]" id="products" multiple class="form-control select2">
                                @foreach(\App\Model\Product::get() as $cats)
                                    <option {{old('products') == $cats->id ? 'selected="selected"' : '' }}
                                        value="{{ $cats->id }}">{{$cats->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($errors->has('products'))
                        <span class="help-block">
                            {{ $errors->first('products') }}
                        </span>
                    @endif
                    </div>

                    <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                        {!! Form::label('details','deal details *') !!}
                        {!! Form::text('details',old('details'),['class'=>'form-control']) !!}
                        @if ($errors->has('details'))
                            <span class="help-block">
                                {{ $errors->first('details') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                        {!! Form::label('expiry_date','Expiry Date *') !!}
                        {!! Form::date('expiry_date','', ['class'=> 'form-control']) !!}

                        @if ($errors->has('expiry_date'))
                            <span class="help-block">
                                {{ $errors->first('expiry_date') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        {!! Form::label('image','Expiry Date *') !!}
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
