<!DOCTYPE html>
<html>
<head>

    <title>HR CRM</title>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet"
          href="{{ asset('assets/css/style.css') }}">

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar d-flex flex-column justify-content-between">

    <div>

        <!-- LOGO -->

        <div class="logo fw-bold text-center py-4 border-bottom">

            <i class="bi bi-person-badge-fill me-2"></i>

            HR CRM

        </div>


        <!-- SIDEBAR MENU -->

        <div class="sidebar-menu p-3">


            <!-- DASHBOARD -->

            <a href="{{ route('hr.dashboard') }}"
               class="{{ request()->routeIs('hr.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>


            <!-- EMPLOYEES -->

            <a href="{{ route('hr.employees.index') }}"
               class="{{ request()->routeIs('hr.employees.*') ? 'active' : '' }}">

                <i class="bi bi-people"></i>

                Employees

            </a>


            <!-- ATTENDANCE -->

            <a href="{{ route('hr.attendance.index') }}"
               class="{{ request()->routeIs('hr.attendance.*') ? 'active' : '' }}">

                <i class="bi bi-calendar-check"></i>

                Attendance

            </a>


            <!-- SALARY -->

            <a href="{{ route('hr.salary.index') }}"
               class="{{ request()->routeIs('hr.salary.*') ? 'active' : '' }}">

                <i class="bi bi-cash-stack"></i>

                Salary

            </a>


            <!-- PERFORMANCE -->

            <a href="{{ route('hr.performance.index') }}"
               class="{{ request()->routeIs('hr.performance.*') ? 'active' : '' }}">

                <i class="bi bi-graph-up"></i>

                Performance

            </a>


            <!-- LEAVE -->

            <a href="{{ route('hr.leave.index') }}"
               class="{{ request()->routeIs('hr.leave.*') ? 'active' : '' }}">

                <i class="bi bi-airplane"></i>

                Leave

            </a>


            <!-- REPORTS -->

            <a href="{{ route('hr.reports.index') }}"
               class="{{ request()->routeIs('hr.reports.*') ? 'active' : '' }}">

                <i class="bi bi-file-earmark-bar-graph"></i>

                Reports

            </a>

        </div>

    </div>


    <!-- LOGOUT -->

    <div class="p-3 border-top">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button type="submit"
                    class="btn btn-danger w-100 rounded-3">

                <i class="bi bi-box-arrow-right me-1"></i>

                Logout

            </button>

        </form>

    </div>

</div>



<!-- MAIN CONTENT -->

<div class="main-content">


    <!-- TOP NAVBAR -->

    <div class="top-navbar d-flex justify-content-between align-items-center px-4 py-3 shadow-sm">


        <!-- SEARCH -->

        <div class="search-box w-50">

            <div class="input-group">

                <span class="input-group-text bg-white border-end-0">

                    <i class="bi bi-search"></i>

                </span>

                <input type="text"
                       class="form-control border-start-0"
                       placeholder="Search here...">

            </div>

        </div>


        <!-- PROFILE -->

        <div class="profile-area d-flex align-items-center gap-3">


            <!-- NOTIFICATION -->

            <div class="position-relative">

                <i class="bi bi-bell fs-5"></i>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                    3

                </span>

            </div>


            <!-- PROFILE IMAGE -->

            <img src="https://i.pravatar.cc/40"
                 width="40"
                 height="40"
                 class="rounded-circle shadow-sm">


            <!-- USER INFO -->

            <div>

                <div class="fw-semibold">

                    HR Manager

                </div>

                <small class="text-muted">

                    Human Resource

                </small>

            </div>

        </div>

    </div>


    <!-- PAGE CONTENT -->

    <div class="p-4">

        @yield('content')

    </div>

</div>



<!-- SCRIPTS -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')

</body>
</html>
