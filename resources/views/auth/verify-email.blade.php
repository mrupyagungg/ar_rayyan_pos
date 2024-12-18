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

    <title>Verify Email | Ar Rayyan POS</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('style/assets/img/logo_sambeljerit.png') }}" />
  </head>
  <body class="login-body">
    <div class="container-fluid login-wrapper">
        <div class="login-box">
            <h1 class="text-center mb-5"><i><img src="{{asset('style/assets/img/logo_sambeljerit.png')}}"alt="" class="rounded-circle" width="150px" height="150px"></i> AR-RAYYAN POS</h1>    
            <div class="row">
                <div class="col-md-6 col-sm-6 col-12 login-box-info">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12 login-box-form p-4">
                    <h3 class="mb-2">Login</h3>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-button>
                                    {{ __('Resend Verification Email') }}
                                </x-button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    

<!--Page Wrapper-->

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