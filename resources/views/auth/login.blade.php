<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="description" content="Responsive Admin Template"/>
    <meta name="author" content="RedstarHospital"/>
    <title>Insurance|Login</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css"/>
    <!-- icons -->
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- <link rel="stylesheet" href="../assets/plugins/iconic/css/material-design-iconic-font.min.css"> -->
    <link rel="stylesheet"
          href="{{ asset('assets/plugins/material/material.min.css') }}">
    <!-- bootstrap -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/css/pages/extra_pages.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}"/>
</head>
<body>
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-logo">
						<img alt="" src="{{ asset('assets/img/hospital.png') }}">
					</span>
                <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                <div class="wrap-input100 validate-input" data-validate="Enter Email">
                    <input class="input100" type="email" name="email" @error('email') is-invalid
                           @enderror value="{{ old('email') }}" placeholder="Email">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" @error('password') is-invalid
                           @enderror value="{{ old('password') }}" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                @if ($errors->any())
                    <div class="invalid-message">
                        Email or Password was wrong please try with write one
                    </div>
                @endif
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
                <div class="text-center p-t-30">
                    <a class="txt1" href="forgot_password.html">
                        Forgot Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- start js include path -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/extra_pages/login.js') }}"></script>
<!-- end js include path -->
</body>


</html>
