@extends('frontend.layouts.master')
@section('page_name')
    <span class="breadcrumb-item active">Login</span>
    @endsection
@section('content')

    <div id="main-inner-page">
        <div class="container">
            <div id="login-page">
                <h2 class="home-heading text-center">
                    Login
                </h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form class="needs-validation main-form"  method="POST" action="{{ route('login') }}">
                                @csrf
                                    <!--  -->
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">Username or email address *</label>
                                            <input type="text" class="form-control mb-3 mb-md-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email"  required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">Password *</label>
                                            <input type="password" class="form-control mb-3 mb-md-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox"  name="remember" id="remember" class="form-check-input"  {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Check1">Remember me</label>
                                    </div>

                                    <!--  -->
                                    <button type="submit" class="btn">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
