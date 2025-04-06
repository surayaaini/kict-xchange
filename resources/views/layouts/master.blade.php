<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>MYKICT</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logokict.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    {{-- <link rel="stylesheet" href="assets/plugins/simple-calendar/simple-calendar.css"> --}}

</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="dashboard" class="logo">
                    <img src="{{ asset('assets/img/LOGO-KICT.png') }}" alt="Logo">
                </a>
                <a href="dashboard" class="logo logo-small">
                    <img src="{{ asset('assets/img/LOGO-KICT.png') }}" alt="Logo">
                </a>
            </div>

            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="nav user-menu align-items-center">

            <ul class="nav user-menu">
                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <img src="{{ asset('assets/img/icons/header-icon-04.svg') }}" alt="Logo">

                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <div class="user-text">
                                @if(Auth::check())
                                <span class="user-img mt-4">
                                    <img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="{{ Auth::user()->name }}">
                                    <div class="user-text">
                                        <h6>{{ Auth::user()->name }}</h6>
                                        <p class="text-muted mb-0">{{ Auth::user()->role->name ?? 'No Role' }}</p>
                                    </div>
                                </span>
                                @endif
                            </div>
                        </span>
                    </a>


                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" alt="User Image">
                            </div>
                            <div class="user-text">
                                <h6>{{ Auth::user()->name }}</h6>
                                <p class="text-muted mb-0">{{ Auth::user()->role->name }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>

                    </div>
                </li>

            </ul>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>

                        {{-- ADMIN VIEW --}}
                        @if (Auth::user()->role_id == '1')
                        <li class="submenu active">
                            <a href="#"><i class="feather-grid"></i> <span> KICT X-Change</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="admin-dashboard">Admin Dashboard</a></li>
                                <li><a href="{{ route('moumoa.index') }}">MOU/MOA List</a></li>
                                {{-- <li><a href="teacher-dashboard">Teacher Dashboard</a></li>
                                <li><a href="student-dashboard">Student Dashboard</a></li> --}}
                            </ul>
                        </li>
                        @endif

                        @if (Auth::user()->role_id == '2')
                        <li class="submenu">
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> KICT X-Change</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li><a href="student-dashboard">Mobility Programmes</a></li>
                                <li><a href="{{ route('moumoa.index') }}">MOU/MOA List</a></li>
                                <li><a href="edit-teacher.html">Student Experience</a></li>
                                <li><a href="edit-teacher.html">FAQ</a></li>

                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->role_id == '3')
                            <li class="submenu">
                                <a href="#"><i class="fas fa-graduation-cap"></i> <span>KICT X-Change</span> <span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="admin-welcome">Outbound Mobility Proposal</a></li>
                                    <li><a href="{{ route('moumoa.index') }}">MOU/MOA List</a></li>
                                    <!--<li><a href="add-student.html">Student Add</a></li>-->
                                    <!--<li><a href="edit-student.html">Student Edit</a></li>-->
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>


        <div class="page-wrapper">

            @yield('content')

            <footer>
                <p>Copyright © 2025 MYKICT.</p>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
