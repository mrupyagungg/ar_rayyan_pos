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

    <title>Forgot Password | Ar Rayyan POS</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('style/assets/img/logo_sambeljerit.png') }}" />
  </head>
  <body class="login-body">
        <div class="container-fluid login-wrapper">
            <div class="login-box">
                <h1 class="text-center mb-5"><i><img src="{{asset('style/assets/img/logo_sambeljerit.png')}}"alt="" class="rounded-circle" width="150px" height="150px"></i> AR-RAYYAN POS</h1>    
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12 login-box-info">

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
                        <h3 class="mb-4">Forgot password</h3>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="btn btn-primary">
                                    {{ __('Email Password Reset Link') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    

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