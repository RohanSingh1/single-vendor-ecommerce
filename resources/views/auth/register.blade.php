@extends('frontend.layouts.master')
@section('page_name')
<span class="breadcrumb-item active">Register</span>
@endsection
@section('content')
    <div id="main-inner-page">
        <div class="container">
            <div id="login-page">
                <h2 class="home-heading text-center">
                    {{ __('Register') }}
                </h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form class="needs-validation main-form" wasvalidate=""  method="POST" action="{{ route('register') }}" >
                                    <!--  -->
                                    @csrf
                                    @include('inc.messages')
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">{{ __('First Name') }} *</label>
                                            <input type="text" class="form-control mb-3 mb-md-0 @error('f_name') is-invalid @enderror"  name="f_name" id="f_name" placeholder="" autocomplete="f_name"  value="{{ old('f_name') }}" required>
                                            @error('f_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">{{ __('Last Name') }} *</label>
                                            <input type="text" class="form-control mb-3 mb-md-0 @error('l_name') is-invalid @enderror"  name="l_name" id="l_name" placeholder=""  value="{{ old('l_name') }}" autocomplete="l_name" required>
                                            @error('l_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">Email address *</label>
                                            <input type="text" class="form-control mb-3 mb-md-0 @error('email') is-invalid @enderror" name="email"
                                                   value="{{ old('email') }}" required autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">{{ __('Phone no ') }}</label>
                                            <input type="text" class="form-control mb-3 mb-md-0 @error('phone_no') is-invalid @enderror" name="phone_no"
                                                   value="{{ old('phone_no') }}" required autocomplete="phone_no">
                                            @error('phone_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">Password *</label>
                                            <input type="password" class="form-control mb-3 mb-md-0  @error('password') is-invalid @enderror" name="password"
                                                   required autocomplete="new-password" id="password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12">
                                            <label for="">{{ __('Confirm Password') }}</label>
                                            <input class="form-control mb-3 mb-md-0" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-text">
                                        <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                                    </div>

                                    <!--  -->
                                    <button type="submit" class="btn">
                                        Register
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
