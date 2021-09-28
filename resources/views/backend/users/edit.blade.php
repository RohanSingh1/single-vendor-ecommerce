@extends ('backend.layouts.master')
@section('page_title')
    Users
@endsection

@section('content-head-title')
  Users
  @endsection
@section('content-head-body')

@endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit Users / Delivery Boys
                <div class="page-title-subheading">Edit Users / Delivery Boys here
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            <a href="{{ route('admin.users') }}"><div class="btn btn-warning btn-outline" >Back</div></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                      Edit Category
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['action' => ['UsersController@update',$data->id],'method' => 'POST','enctype'=>'multipart/form-data' ]) !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                              @include('inc.messages')
                              <div class="form-group">
                                  {{Form::label('name', 'Full Name')}}
                                {{Form::text('name',$data->name,['class' => 'form-control','placeholder' => 'Name'])}}
                              </div>
                              <div class="form-group">
                                {{Form::label('email', 'Email')}}
                                {{Form::text('email',$data->email,['class' => 'form-control','placeholder' => 'Email','readonly'])}}
                              </div>
                              <div class="form-group">
                                {{Form::label('password', 'Password')}}
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>

                            <div class="form-group">
                                {{Form::label('address', 'Address')}}
                                {{Form::textarea('address',$data->address,['class' => 'form-control'])}}
                              </div>

                              <div class="form-group">
                                <label for="is_admin">{{ __('User Type') }}</label>
                                <div class="col-md-6">
                                    <input type="radio" name="is_admin" value="1">Admin
                                    <input type="radio" name="is_admin" value="0" required checked>Delivery Boy
                                    @if ($errors->has('is_admin'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('is_admin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                {!! Form::label('image','Image *') !!}
                                {!! Form::file('image', ['class'=> 'form-control']) !!}
                                <br>
                                <p>Current Image</p>
                                <span>
                                    <a href="{{ asset('storage/Uploads/Users/'.$data->image) }}">
                                        <img src="{{ asset('storage/Uploads/Users/'.$data->image)  }}" style="width:300px" alt="Deal Image">
                                    </a>
                                </span>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        {{ $errors->first('image') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                {!! Form::label('status','Status *') !!}
                                {!! Form::select('status',['1' => 'Active','0' => 'In-Active'],
                                $data->status, ['class'=>'form-control']); !!}

                                @if ($errors->has('status'))
                                <span class="help-block">
                                    {{ $errors->first('status') }}
                                </span>
                                @endif
                            </div>
                            </div>

                            <div class="card-footer">
                              {{Form::submit('Update',['class'=>'btn btn-success'])}}
                            {!! Form::close() !!}
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
        <!-- /.content -->
@endsection

