<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from fresco.net/html-items/gambo_supermarket_demo/sign_up.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Jul 2021 16:06:43 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="fresco">
    <meta name="author" content="fresco">
    <title>Gambo - Sign Up</title>

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
    <link rel="stylesheet" type="text/css" href="vendor/semantic/semantic.min.css">
</head>

<body>
    <div class="sign-inup">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="sign-form">
                        <div class="sign-inner">
                            <div class="sign-logo" id="logo">
                                <a href="index.html"><img src="images/logo.svg" alt=""></a>
                                <a href="index.html"><img class="logo-inverse" src="images/dark-logo.svg" alt=""></a>
                            </div>
                            <div class="form-dt">
                                <div class="form-inpts checout-address-step">
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        @include('front.layouts.session_messages')
                                        @include('front.layouts.form_messages')
                                        <input type="hidden" name="redirect-to" value="{{ request()->has('redirect-to') ? request()->get('redirect-to') :'' }}">
                                        <div class="form-title">
                                            <h6>Sign Up</h6>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input id="full[name]" name="name" type="text" placeholder="Full name"
                                                class="form-control lgn_input" required="" value="{{ old('name') }}">
                                            <i class="uil uil-user-circle lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input id="email[address]" name="email" type="email" value="{{ old('email') }}"
                                                placeholder="Email Address" class="form-control lgn_input" required="">
                                            <i class="uil uil-envelope lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <input id="phone[number]" name="phone_no" type="text" value="{{ old('phone_no') }}"
                                                placeholder="Phone Number" class="form-control lgn_input" required="">
                                            <i class="uil uil-mobile-android-alt lgn_icon"></i>
                                        </div>

                                        <div class="form-group pos_rel">
                                            <input id="password1" name="password" type="password"
                                                placeholder="Enter Password" class="form-control lgn_input" required="">
                                            <i class="uil uil-padlock lgn_icon"></i>
                                        </div>

                                        <div class="form-group pos_rel">
                                            <input id="password1" name="password_confirmation" type="password"
                                                placeholder="Confirm Password" class="form-control lgn_input" required="">
                                            <i class="uil uil-padlock lgn_icon"></i>
                                        </div>
                                        <div class="form-group pos_rel">
                                            <label for="">Gender:</label>
                                            <input id="gender" name="gender" type="radio" value="male"
                                               required="">Male
                                                <input id="gender" name="gender" type="radio" value="female"
                                               required="">Female
                                        </div>
                                        <button class="login-btn hover-btn" type="submit">Sign Up Now</button>
                                    </form>
                                </div>
                                <div class="signup-link">
                                    <p>I have an account? - <a href="{{ route('login') }}">Sign In Now</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="copyright-text text-center mt-3">
                        <i class="uil uil-copyright"></i>Copyright {{ date('Y') }} <b>fresco</b> . All rights reserved
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

<!-- Mirrored from fresco.net/html-items/gambo_supermarket_demo/sign_up.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Jul 2021 16:06:43 GMT -->

</html>
