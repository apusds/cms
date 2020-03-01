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
    <title>SDS | Form Builder </title>

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
    @stack('styles')
</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- PAGE CONTENT-->
    <div class="page-content--bgf7">
        <br>
        <br>
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
@stack('scripts')
</body>

</html>
<!-- end document-->
