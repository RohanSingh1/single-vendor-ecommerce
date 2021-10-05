<div class="pop-model">
    <div class="modal fade" id="addCoupon" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Coupon</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['CouponController@store'],'method' => 'POST','enctype'=>'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {{Form::label('Coupon Name')}}
                        {{Form::text('coupon_name','',['class'=>'form-control'])}}
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

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        {!! Form::label('type','Coupon Type *') !!}

                        {!! Form::select('type',['flat_discounts' => 'Flat Discounts (Price)',
                         'percentage_discounts' => 'Percentage Discounts'], null, ['class'=>'form-control','placeholder' => 'Select Coupon Type Now ....']); !!}

                        @if ($errors->has('type'))
                            <span class="help-block">
                                {{ $errors->first('type') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                        {!! Form::label('value','Value *') !!}
                        {!! Form::number('value',null, ['class'=> 'form-control']) !!}
                        @if ($errors->has('value'))
                            <span class="help-block">
                                {{ $errors->first('value') }}
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

                    <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                        {!! Form::label('expiry_date','Expiry Date *') !!}
                        {!! Form::date('expiry_date',null, ['class'=> 'form-control']) !!}

                        @if ($errors->has('expiry_date'))
                            <span class="help-block">
                                {{ $errors->first('expiry_date') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        {!! Form::label('status','Status *') !!}

                        {!! Form::select('status',['1' => 'Active',
                         '0' => 'In-Active'], null, ['class'=>'form-control','placeholder' => 'Select Status']); !!}

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
