<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/bootstrap.min.css">
    <!--Custom style.css-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/quicksand.css">
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/style.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/fontawesome.css">

    <title>Login | Ar Rayyan POS</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('style/assets/img/logo_sambeljerit.png') }}" />
  </head>
  <body class="login-body">
    
    <!--Login Wrapper-->

    <div class="container-fluid login-wrapper">
        <div class="login-box">
            <h1 class="text-center mb-5"><i><img src="{{asset('style/assets/img/logo_sambeljerit.png')}}"alt="" class="rounded-circle" width="150px" height="150px"></i> AR-RAYYAN POS</h1>    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12 login-box-info">
                    <h3 class="mb-4">Sign up</h3>
                    <p class="mb-4">Don't have an account?</p>
                    <p class="text-center"><a href="{{ route('register') }}" class="btn btn-light">Register here</a></p>
                </div>
                <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
                    <h3 class="mb-2">Login</h3>
                    <small class="text-muted bc-description">Sign in with your credentials</small>
                    <form method="POST" action="{{ route('login') }}" class="mt-2">
                        @csrf
                        <!-- Email Address -->
                        <div class="mb-4">
                            
                            <x-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                        </div>
                    
                        <!-- Password -->
                        <div class="mb-4">
                          
                            <x-input id="password" class="form-control mt-1" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                        </div>
                    
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                    
                        <div class="flex items-center justify-between mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                    
                            <!-- Login Button -->
                            <x-button class="btn btn-primary ml-3">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    

    <!--Login Wrapper-->

    <!-- Page JavaScript Files-->
    <script src="{{asset('Sleekadmin')}}/assets/js/jquery.min.js"></script>
    <script src="{{asset('Sleekadmin')}}/assets/js/jquery-1.12.4.min.js"></script>
    <!--Popper JS-->
    <script src="{{asset('Sleekadmin')}}/assets/js/popper.min.js"></script>
    <!--Bootstrap-->
    <script src="{{asset('Sleekadmin')}}/assets/js/bootstrap.min.js"></script>

    <!--Custom Js Script-->
    <script src="{{asset('Sleekadmin')}}/assets/js/custom.js"></script>
    <!--Custom Js Script-->
  </body>
</html>