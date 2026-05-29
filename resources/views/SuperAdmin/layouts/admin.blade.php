<!DOCTYPE html>
<html>
<head>

    <title>ADMIN CRM</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

<div class="sidebar d-flex flex-column justify-content-between">

    <div>

        <div class="logo fw-bold text-center py-4 border-bottom">
            <i class="bi bi-shield-lock-fill me-2"></i>
            SUPERADMIN CRM
        </div>

        <div class="sidebar-menu p-3">

            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Employees
            </a>

            <a href="{{ route('attendance.index') }}" class="{{ request()->routeIs('attendance.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> Attendance
            </a>

            <a href="{{ route('superadmin.salaries.index') }}" class="{{ request()->routeIs('superadmin.salaries.*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack"></i> Salary & Payroll
            </a>

            <a href="{{ route('daily-work.index') }}" class="{{ request()->routeIs('daily-work.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Daily Work
            </a>

            <a href="{{ route('performance.index') }}" class="{{ request()->routeIs('performance.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i> Performance
            </a>

            <a href="{{ route('leave.index') }}" class="{{ request()->routeIs('leave.*') ? 'active' : '' }}">
                <i class="bi bi-airplane"></i> Leave Management
            </a>

            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i> Roles & Permissions
            </a>

            <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i> Reports
            </a>

        </div>
    </div>



</div>

<div class="main-content">

    <!-- TOP NAV -->
    <div class="top-navbar d-flex justify-content-between align-items-center px-4 py-3 shadow-sm">

        <div class="search-box w-50">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Search here...">
            </div>
        </div>

        <div class="dropdown">

            <div class="profile-area d-flex align-items-center gap-3" data-bs-toggle="dropdown" style="cursor:pointer;">
                <img src="https://i.pravatar.cc/40" class="rounded-circle shadow-sm" width="40" height="40">

                <div>
                    <div class="fw-semibold">{{ Auth::user()->name }}</div>
                    <small class="text-muted">Super Admin</small>
                </div>
            </div>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2">

                <li>
                    <a href="{{ route('admin.profile') }}" class="dropdown-item rounded-3">
                        <i class="bi bi-person-circle me-2"></i> Profile
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form id="logoutFormDropdown" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger rounded-3">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>

        </div>

    </div>

    <!-- PAGE CONTENT -->
    <div class="p-4">
        @yield('content')
    </div>

</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('scripts')

<!-- ================= GLOBAL CONFIRM FUNCTION ================= -->
<script>
    function confirmAction(options) {

        Swal.fire({
            title: options.title ?? 'Are you sure?',
            text: options.text ?? '',
            icon: options.icon ?? 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: options.confirmText ?? 'Yes',
            cancelButtonText: options.cancelText ?? 'Cancel'
        }).then((result) => {

            if (result.isConfirmed && typeof options.onConfirm === 'function') {
                options.onConfirm();
            }

        });

    }
</script>

<!-- ================= LOGOUT CONFIRM ================= -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        function attachLogout(id) {

            const form = document.getElementById(id);

            if (!form) return;

            form.addEventListener('submit', function (e) {

                e.preventDefault();

                confirmAction({
                    title: 'Logout?',
                    text: 'You will be signed out from system',
                    confirmText: 'Yes, Logout',
                    onConfirm: () => this.submit()
                });

            });

        }


        attachLogout('logoutFormDropdown');

    });
</script>

</body>
</html>
