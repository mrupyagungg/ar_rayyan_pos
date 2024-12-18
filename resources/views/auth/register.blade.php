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

    <title>Register | Ar Rayyan POS</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('style/assets/img/logo_sambeljerit.png') }}" />
  </head>
  <body class="login-body">
        <div class="container-fluid login-wrapper">
            <div class="login-box">
                <h1 class="text-center mb-3"><i><img src="{{asset('style/assets/img/logo_sambeljerit.png')}}"alt="" class="rounded-circle" width="150px" height="150px"></i> AR-RAYYAN POS</h1>  
                <div class="row">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="col-md-6 col-sm-6 col-12 login-box-info">
                        <h3 class="mb-4">Sign in</h3>
                        <p class="mb-4">Have an account?</p>
                        <p class="text-center"><a href="{{ route('login') }}" class="btn btn-light">Login here</a></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
                        <h3 class="mb-2">Sign up</h3>
                        <small class="text-muted bc-description">Create new account</small>    

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input id="name" class="form-control block mt-2 w-full" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-2">
                                <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required />
                            </div>

                            <!-- Password -->
                            <div class="mt-2">
                                <x-input id="password" class="form-control block mt-1 w-full"
                                                type="password"
                                                name="password" placeholder="Password"
                                                required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-2">
                                <x-input id="password_confirmation" class="form-control block mt-1 w-full"
                                                type="password" placeholder="Confirm Password"
                                                name="password_confirmation" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-button class="btn btn-primary ml-4">
                                    {{ __('Register') }}
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