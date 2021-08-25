<div class="pop-model"  >
    <div class="modal fade" id="addForm" role="dialog">
        <div class="modal-dialog" role  = "document">
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User / Delivery Boy</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{ route('admin.register.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
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

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        {!! Form::label('address','Address') !!}
                        {!! Form::textarea('address','',['class'=>'form-control']) !!}

                        @if ($errors->has('address'))
                            <span class="help-block">
                                {{ $errors->first('address') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

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

                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="col-md-6">
                            <input type="radio" name="status" value="1">Active
                            <input type="radio" name="status" value="0" required checked>In-Active
                            @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

