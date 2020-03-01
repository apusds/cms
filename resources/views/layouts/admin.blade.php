<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard">
    <meta name="author" content="APUSDS">
    <meta name="keywords" content="sds apu google">

    <!-- Title Page-->
    <title>SDS | @yield('title') </title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('dashboard/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('dashboard/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('dashboard/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('dashboard/css/theme.css') }}" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('img/sds.png') }}" style="max-width: 12% !important;" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.dashboard.profile') }}">
                                    <i class="fas fa-user"></i>My Profile
                                    <span class="bot-line"></span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.dashboard.members') }}">
                                    <i class="fas fa-users"></i>Members
                                    <span class="bot-line"></span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.dashboard.events') }}">
                                    <i class="fas fa-list"></i>Event Management
                                    <span class="bot-line"></span>
                                </a>
                            </li>

                            <li>
                                <a href="/forms/builder">
                                    <i class="fas fa-list"></i>Form Builder
                                    <span class="bot-line"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{ auth()->user()->username }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <h5 class="name">
                                            <h3>{{ auth()->user()->username }}</h3>
                                        </h5>
                                        <span class="email">{{ auth()->user()->email }}</span>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('admin.dashboard.profile') }}">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="{{ route('admin.logout') }}">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="#">
                            <img src="{{ asset('img/sds.png') }}" style="max-width: 40% !important;" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                                <span class="bot-line"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.dashboard.profile') }}">
                                <i class="fas fa-user"></i>My Profile
                                <span class="bot-line"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.dashboard.members') }}">
                                <i class="fas fa-users"></i>Members
                                <span class="bot-line"></span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.dashboard.events') }}">
                                <i class="fas fa-list"></i>Event Management
                                <span class="bot-line"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="content">
                            <a class="js-acc-btn" href="#">{{ auth()->user()->username }}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <h5 class="name">
                                    <h3>{{ auth()->user()->username }}</h3>
                                </h5>
                                <span class="email">{{ auth()->user()->email }}</span>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="{{ route('admin.dashboard.profile') }}">
                                        <i class="zmdi zmdi-account"></i>Account</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="{{ route('admin.logout') }}">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="{{ route('admin.dashboard') }}" style="color: red;">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">@yield('title')</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            @yield('content')
        </div>

        <!-- COPYRIGHT-->
        <section class="p-t-60 p-b-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2020 APUSDS. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END COPYRIGHT-->

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('dashboard/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('dashboard/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('dashboard/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('dashboard/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
</body>

</html>
<!-- end document-->
