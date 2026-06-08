<!DOCTYPE html>
<html>
<head>
    <title>Employee CRM</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="mainpage">

<div class="sidebar d-flex flex-column justify-content-between">

    <div>
        <div class="sidebar-logo">
            <i class="bi bi-shield-lock-fill me-2"></i>
            Employee CRM
        </div>

        <div class="mt-3">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>

            @hasanyrole('super-admin|hr')
            <a href="{{ route('employees.index') }}"
               class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Employees
            </a>
            @endhasanyrole

            @role('manager')
            <a href="{{ route('employees.index') }}"
               class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                Team Employees
            </a>
            @endrole
            @role('employee')

            @can('employee.profile.view.self')

                <a href="{{ route('employees.index') }}"
                   class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>

            @else

                <a href="javascript:void(0)"
                   class="disabled text-secondary"
                   style="pointer-events:none; opacity:.6;">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>

            @endcan

            @endrole


            @if(
      auth()->user()->hasAnyRole(['super-admin', 'hr', 'manager'])
      || auth()->user()->can('attendance.view.self')
  )

                <a href="{{ route('attendance.index') }}"
                   class="{{ request()->routeIs('attendance.*') ? 'active' : '' }}">

                    <i class="bi bi-calendar-check"></i>

                    Attendance

                </a>

            @else

                <a href="javascript:void(0)"
                   class="text-secondary"
                   style="pointer-events:none; opacity:.6;">

                    <i class="bi bi-calendar-check"></i>

                    Attendance

                </a>

            @endif

            @hasanyrole('super-admin|hr|employee')
            <a href="{{ route('salary.index') }}"
               class="{{ request()->routeIs('salary.*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack"></i>
                Salary & Payroll
            </a>
            @endhasanyrole

            @hasanyrole('super-admin|manager|employee')
            <a href="{{ route('daily-work.index') }}"
               class="{{ request()->routeIs('daily-work.*') ? 'active' : '' }}">
                <i class="bi bi-journal-check"></i>
                Daily Work
            </a>
            @endhasanyrole

            @hasanyrole('super-admin|hr|manager|employee')
            <a href="{{ route('performance.index') }}"
               class="{{ request()->routeIs('performance.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i>
                Performance
            </a>
            @endhasanyrole

            @hasanyrole('super-admin|hr|employee')
            <a href="{{ route('leave.index') }}"
               class="{{ request()->routeIs('leave.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-x"></i>
                Leave
            </a>
            @endhasanyrole

            @hasanyrole('super-admin|hr|manager')
            <a href="{{ route('reports.index') }}"
               class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i>
                Reports
            </a>
            @endhasanyrole


            @role('super-admin')

            <a href="{{ route('roles.index') }}"
               class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="bi bi-shield-check"></i>
                Roles & Permissions
            </a>


            <a href="{{ route('users.index') }}"
               class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i>
                User Management
            </a>


            @endrole

        </div>
    </div>



</div>

<div class="main-content">

    <!-- TOP NAVBAR -->
    <div class="top-navbar bg-white shadow-sm px-4 py-3 d-flex justify-content-between align-items-center">

        <!-- Search -->
        <div class="w-50 position-relative">

            <div class="input-group">
        <span class="input-group-text bg-white border-end-0">
            <i class="bi bi-search"></i>
        </span>

                <input type="text"
                       id="globalSearchInput"
                       class="form-control border-start-0"
                       placeholder="Search employees, salary, leave...">
            </div>

            <div id="globalSearchResult"
                 class="bg-white shadow rounded-4 position-absolute w-100 mt-2 d-none"
                 style="z-index:9999; max-height:400px; overflow-y:auto;">
            </div>

        </div>

        <!-- PROFILE -->
        <div class="dropdown">

            <div class="d-flex align-items-center gap-3"
                 data-bs-toggle="dropdown"
                 style="cursor:pointer;">

                <img src="https://i.pravatar.cc/40"
                     class="rounded-circle shadow"
                     width="45"
                     height="45">

                <div>

                    <h6 class="mb-0 fw-bold">

                        {{ auth()->user()->name }}

                    </h6>

                    <small class="text-muted">

                        {{ ucfirst(auth()->user()->getRoleNames()->first()) }}

                    </small>

                </div>

            </div>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2">

                <li>

                    <a href="{{ route('profile.index') }}"
                       class="dropdown-item rounded-3">

                        <i class="bi bi-person-circle me-2"></i>

                        My Profile

                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <form method="POST"
                          action="{{ route('logout') }}"
                          class="logout-confirm">
                        @csrf

                        <button type="submit"
                                class="dropdown-item text-danger rounded-3">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </button>
                    </form>

                </li>

            </ul>

        </div>

    </div>
    <div class="content-wrapper">

        @if(session('success'))
            <div class="alert alert-success rounded-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger rounded-3">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        let input = document.getElementById('globalSearchInput');
        let resultBox = document.getElementById('globalSearchResult');

        input.addEventListener('input', function () {

            let q = this.value.trim();

            if (q.length < 2) {
                resultBox.classList.add('d-none');
                resultBox.innerHTML = '';
                return;
            }

            fetch("{{ route('search.live') }}?q=" + encodeURIComponent(q))
                .then(response => response.json())
                .then(data => {

                    resultBox.innerHTML = '';

                    if (data.length === 0) {
                        resultBox.innerHTML = `
                        <div class="p-3 text-muted">
                            No result found
                        </div>
                    `;
                        resultBox.classList.remove('d-none');
                        return;
                    }

                    data.forEach(item => {
                        resultBox.innerHTML += `
                        <a href="${item.url}" class="d-block text-decoration-none text-dark p-3 border-bottom">
                            <div class="fw-bold">${item.title}</div>
                            <small class="text-muted">${item.type} - ${item.subtitle ?? ''}</small>
                        </a>
                    `;
                    });

                    resultBox.classList.remove('d-none');
                });
        });

        document.addEventListener('click', function (e) {
            if (!input.contains(e.target) && !resultBox.contains(e.target)) {
                resultBox.classList.add('d-none');
            }
        });

    });
</script>
</body>
</html>
