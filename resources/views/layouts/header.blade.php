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

    <!--Favicon Icon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/bootstrap.min.css">
    <!--Custom style.css-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/quicksand.css">
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/style.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/fontawesome.css">
    <!--Animate CSS-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/animate.min.css">
    <!--Chartist CSS-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/chartist.min.css">
    <!--Map-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/jquery-jvectormap-2.0.2.css">
    <!--Bootstrap Calendar-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/js/calendar/bootstrap_calendar.css">
    <!--Nice select -->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/nice-select.css">
    <!--Datatable-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/dataTables.bootstrap4.min.css">
    <!--Alertify CSS-->
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/alertify.min.css">
    <link rel="stylesheet" href="{{asset('Sleekadmin')}}/assets/css/themes/default.rtl.min.css">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>@yield('title') | Ar Rayyan POS</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('style/assets/img/logo_sambeljerit.png') }}" />
  </head>

  <body>
    <!--Page loader-->
    <div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader-wave"></div>
        </div>
    </div>
    <!--Page loader-->
    
    <!--Page Wrapper-->

    <div class="container-fluid">

        <!--Header-->
        <div class="row header shadow-sm">
            
            <!--Logo-->
            <div class="col-sm-3 pl-0 text-center header-logo">
                <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                     <h3 class="logo"><a href="#" class="text-secondary logo"><i class="fa fa-usd"></i> Point Of Sales</a></h3>
                </div>
             </div>
             <!--Logo-->

            <!--Header Menu-->
            <div class="col-sm-9 header-menu pt-2 pb-0">
                <div class="row">
                    
                    <!--Menu Icons-->
                    <div class="col-sm-4 col-8 pl-0">
                        <!--Toggle sidebar-->
                        <span class="menu-icon" onclick="toggle_sidebar()">
                            <span id="sidebar-toggle-btn"></span>
                        </span>
                        <!--Toggle sidebar-->
            
                        <!-- Notification icon -->
                        <div class="menu-icon">
                            <a href="#" onclick="toggle_dropdown(this); return false" role="button" class="dropdown-toggle">
                                <i class="fa fa-bell"></i>
                                @if(1> 0)
                                <span class="badge badge-danger">{{ 1}}</span> <!-- Menampilkan jumlah produk expired -->
                                @endif
                            </a>
                            <div class="dropdown dropdown-left bg-white shadow border">
                                <a class="dropdown-item" href="#"><strong>Notifications</strong></a>
                                <div class="dropdown-divider"></div>
                                @if(1> 0)
                                    <a href="{{ route('product.index') }}" class="dropdown-item"> <!-- Menambahkan link ke halaman produk expired -->
                                        <div class="media">
                                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                                                <i class="fa fa-exclamation-triangle"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mt-0"><strong>Expired Products</strong></h6>
                                                <p>{{ 1}} product(s) have expired</p> <!-- Menampilkan jumlah produk expired -->
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <a href="#" class="dropdown-item">No expired products</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center link-all" href="#">See all notifications ></a>
                            </div>
                        </div>
                        <!-- Notification icon -->

                    </div>
                    <!--Menu Icons-->

                    <!--Search box and avatar-->
                    <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                        <div class="mr-4">
                            <a class="">{{ Auth::user()->name }}</a>
                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ url(auth()->user()->foto ?? '') }}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="40px" height="40px">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{url('profil')}}"><i class="fa fa-user pr-2"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-power-off pr-2"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>    
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->
        <!--Main Content-->

        <div class="row main-content">