<!DOCTYPE html>
<html lang="en">
@php
    $site_logo_1 = \App\Model\Setting::select('id', 'file')->where('slug', 'site_logo_1')->first();
    $site_title =  get_general_settings_text('site_title')['text'];
@endphp

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="{{ $site_title }}">
    <meta name="author" content="{{ $site_title }}">
    <title>{{ ucfirst($site_title) }} - Sign In</title>

    <link rel="icon" type="image/png" href="images/fav.png">

    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link href='vendor/unicons-2.0.1/css/unicons.css' rel='stylesheet'>
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/night-mode.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/step-wizard.css') }}" rel="stylesheet">

    <link href="{{ asset('front/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/vendor/semantic/semantic.min.css') }}">
</head>

<body>
    <div class="sign-inup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="sign-form">
                        <div class="sign-inner">
                            <div class="sign-logo" id="logo">
                                <a href="index.html"><img src="{{ asset($site_logo_1->file)  }}" alt="{{ $site_title }}"></a>
                                <a href="index.html"><img class="logo-inverse"
                                        src="{{ asset($site_logo_1->file)  }}" alt="{{ $site_title }}"></a>
                            </div>
                            <div class="form-dt">
                                <div class="form-inpts checout-address-step">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="redirect-to" value="{{ request()->has('redirect-to') ? request()->get('redirect-to') :'' }}">
                                        @include('front.layouts.session_messages')
                                        @include('front.layouts.form_messages')
                                        <div class="form-title">
                                            <h6>Sign In</h6>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input id="phone[number]" name="email" type="text"
                                                placeholder="Enter Email Address" class="form-control lgn_input"
                                                required="">
                                            <i class="uil uil-mobile-android-alt lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input id="password1" name="password" type="password"
                                                placeholder="Enter Password" class="form-control lgn_input" required="">
                                            <i class="uil uil-padlock lgn_icon"></i>
                                        </div>
                                        <button class="login-btn hover-btn" type="submit">Sign In Now</button>
                                    </form>
                                </div>
                                <div class="password-forgor">
                                    <a href="">Forgot Password?</a>
                                </div>
                                <div class="signup-link">
                                    <p>Don't have an account? - <a href="{{ route('register') }}">Sign Up Now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="copyright-text text-center mt-3">
                        <i class="uil uil-copyright"></i>Copyright 2020 <b>{{ $site_title }}</b> . All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('front/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/vendor/OwlCarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('front/vendor/semantic/semantic.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <script src="{{ asset('front/js/product.thumbnail.slider.js') }}"></script>
    <script src="{{ asset('front/js/offset_overlay.js') }}"></script>
    <script src="{{ asset('front/js/night-mode.js') }}"></script>
</body>

<!-- Mirrored from {{ get_general_settings_text('site_title') }}.net/html-items/gambo_supermarket_demo/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Jul 2021 16:06:32 GMT -->

</html>
