<div class="pop-model">
    <div class="modal fade" id="addlocations" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Location Name</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => ['LocationController@store'],'method' => 'POST','enctype'=>'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {{Form::label('Locations Name')}}
                        {{Form::text('name',old('name'),['class'=>'form-control'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('Province Name/No')}}
                        <select name="province_id" class="form-control">
                            @foreach (\App\Model\Province::where('status',1)->get() as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {{Form::label('District Name')}}
                        <select name="district_id" class="form-control">
                            @foreach (\App\Model\District::where('status',1)->get() as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        {{Form::label('Price')}}
                        {{Form::number('price',old('price'),['class'=>'form-control'])}}
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
