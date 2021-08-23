<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | {{ config('app.name') }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('backend/admin-login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/admin-login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/admin-login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/admin-login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/admin-login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/admin-login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/admin-login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/admin-login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('backend/admin-login/images/img-01.png')}}" alt="IMG">
				</div>
				<form class="login100-form validate-form" method="POST" action="{{ route('admin.login') }}">
					@csrf
					<span class="login100-form-title">
						{{__('Member Login')}}
					</span>
					@error('email')
						<div class="wrap-input100 validate-input alert-validate " data-validate = "{{$message}} ">
						</div>
					@enderror
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" id="password" required autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					@error('password')
						<div class="wrap-input100 validate-input  alert-validate " data-validate = "{{$message}} ">
						</div>
					@enderror
					<div class="wrap-input100">
						<div class="ks-checkbox">
						  <input class="form-control" type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
						  <label for="remember-me">{{ __('Remember Me') }}</label>
						</div>
					  </div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							{{__('Login')}}
						</button>
					</div>
					@if (Route::has('password.request'))
						<div class="text-center p-t-12">
							<span class="txt1">
								{{__('Forgot')}}
							</span>
							<a class="txt2" href="{{ route('admin.password.request') }}">
								Username / Password?
							</a>
						</div>
					@endif
					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="{{asset('backend/admin-login/vendor/jquery/jquery-3.2.1.min.js')}} "></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/admin-login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('backend/admin-login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/admin-login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/admin-login/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('backend/admin-login/js/main.js')}}"></script>

</body>
</html>

