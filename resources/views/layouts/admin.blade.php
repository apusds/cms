<!DOCTYPE html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <?php
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        ?>

        <title>SDS | @yield('title') </title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin/custom.css') }}">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <!-- Custom Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    </head>

    <body>
        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i class="fas fa-arrow-left"></i>
                </div>

                <div class="sidebar-header">
                    <h3>Welcome!</h3>
                </div>

                <ul class="list-unstyled components">
                    <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.profile') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.profile') }}">My Profile</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.members') || Request::routeIs('dashboard.members.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.members') }}">Members</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.events') || Request::routeIs('dashboard.events.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.events') }}">Events</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('dashboard.meetups') || Request::routeIs('dashboard.meetups.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dashboard.meetups') }}">Meetups</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.website') || Request::routeIs('dashboard.website.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.website') }}">Website</a>
                    </li>
                    <li class="{{ Request::routeIs('dashboard.gallery') || Request::routeIs('dashboard.gallery.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.gallery') }}">Gallery</a>
                    </li>

                    <li class="{{ Request::routeIs('dashboard.emailer') || Request::routeIs('dashboard.emailer.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.emailer') }}">Emailer</a>
                    </li>

                    @if (Auth::user()->isSuperAdmin())
                        <li class="{{ Request::routeIs('dashboard.users') || Request::routeIs('dashboard.users.*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.users') }}">Users</a>
                        </li>
                        <li class="{{ Request::routeIs('dashboard.roles') || Request::routeIs('dashboard.roles.*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.roles') }}">Roles</a>
                        </li>
                        <li class="{{ Request::routeIs('dashboard.teams') || Request::routeIs('dashboard.teams.*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.teams') }}">Teams</a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content  -->
            <div id="content">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('dashboard.profile') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard.profile') }}">My Profile</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('dashboard.members') || Request::routeIs('dashboard.members.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard.members') }}">Members</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('dashboard.events') || Request::routeIs('dashboard.events.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard.events') }}">Events</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('dashboard.meetups') || Request::routeIs('dashboard.meetups.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard.meetups') }}">Meetups</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('dashboard.website') || Request::routeIs('dashboard.website.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard.website') }}">Website</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('dashboard.gallery') || Request::routeIs('dashboard.gallery.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard.gallery') }}">Gallery</a>
                                </li>
                                <li class="nav-item {{ Request::routeIs('dashboard.emailer') || Request::routeIs('dashboard.emailer.*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard.emailer') }}">Emailer</a>
                                </li>

                                @if (Auth::user()->isSuperAdmin())
                                    <li class="nav-item {{ Request::routeIs('dashboard.users') || Request::routeIs('dashboard.users.*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('dashboard.users') }}">Users</a>
                                    </li>
                                    <li class="nav-item {{ Request::routeIs('dashboard.roles') || Request::routeIs('dashboard.roles.*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('dashboard.roles') }}">Roles</a>
                                    </li>
                                    <li class="nav-item {{ Request::routeIs('dashboard.teams') || Request::routeIs('dashboard.teams.*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('dashboard.teams') }}">Teams</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>

                @if ($message = Session::get('message'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <div class="overlay"></div>

        <!-- jQuery CDN - Minified version -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- include summernote css/js -->
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
        <!-- Custom -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    </body>

</html>
