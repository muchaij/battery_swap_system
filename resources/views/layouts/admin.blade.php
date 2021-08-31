<!DOCTYPE html>
<html lang="en" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Komiut">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A public transport management system with cashless payments and geofencing for PSV vehicles in KENYA.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <!-- Page Title  -->
    <title>Admin Account</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('assets/css/dashlite.css')}}?ver=2.2.0">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/css/theme.css')}}?ver=2.2.0">
    <link rel='stylesheet' href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <link id="skin-default" rel="stylesheet" href="{{asset('css/my_styles.css')}}">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
</head>
<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head bg-dark">
                    <div class="nk-sidebar-brand">
                        <a href="{{url('admin/home')}}" class="logo-link nk-sidebar-logo">
                           <span class='text-white'>Welcome, {{\Auth::user()->firstname}}</span>
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item">
                                    <a href="{{url('admin/home')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <i class='fas fa-home'></i>
                                        </span>
                                        <span class="nk-menu-text">Home</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('admin/assignments')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <i class='fas fa-handshake'></i>
                                        </span>
                                        <span class="nk-menu-text">Assignments</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('admin/batteries')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <i class='fas fa-battery-three-quarters'></i>
                                        </span>
                                        <span class="nk-menu-text">Batteries</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('admin/stations')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <i class='fas fa-map-marker-alt'></i>
                                        </span>
                                        <span class="nk-menu-text">Swap Station</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{url('admin/users')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <i class='fas fa-users'></i>
                                        </span>
                                        <span class="nk-menu-text">Users</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="{{url('admin/profile')}}" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <i class='far fa-user'></i>
                                        </span>
                                        <span class="nk-menu-text">Profile</span>
                                    </a>
                                </li>
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="{{url('admin/home')}}" class="logo-link">
                                    BTA
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-news d-none d-xl-block">
                                <!--<div class="nk-news-list">
                                    <a class="nk-news-item" href="#">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        <div class="nk-news-text">
                                        </div>
                                    </a>
                                </div>-->
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <!--<div class="user-status">Admin</div>-->
                                                    <div class="user-name dropdown-indicator">{{\Auth::user()->firstname}}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                            <em class="icon ni ni-signout"></em>
                                                            <span>{{ __('Logout') }}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->

                                    <!--logout form-->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <!--<div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; {{date('Y')}}</a>
                            </div>
                            <div class="nk-footer-links">
                            </div>
                        </div>
                    </div>
                </div>-->
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>

    @if (\Session::has('success'))
        <div class="notifications bg-success shadow">
            <p class='text-white text-center'><i class='fas fa-check-circle'></i> {!! \Session::get('success') !!}</p>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="notifications bg-danger shadow">
            <p class='text-white text-center'><i class='fas fa-exclamation-circle'></i> {!! \Session::get('error') !!}</p>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="notifications bg-danger shadow">
            <ul class='text-white'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{asset('assets/js/bundle.js')}}?ver=2.2.0"></script>
    <script src="{{asset('assets/js/scripts.js')}}?ver=2.2.0"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

    @stack('js')
    <script>
        $(document).ready(function(){
            setTimeout(() => {
                $('.notifications').hide('slow');
            }, 5000);
        });
    </script>
</body>
</html>
