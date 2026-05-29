@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        {{-- PAGE HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    <i class="bi bi-speedometer2 me-2 text-dark"></i>
                    Employee Dashboard
                </h2>

                <p class="text-muted mb-0">
                    Welcome back 👋 Manage your daily activities easily.
                </p>
            </div>

            <div>
            <span class="badge bg-dark fs-6 px-3 py-2 rounded-pill">
                {{ now()->format('d M Y') }}
            </span>
            </div>

        </div>

        {{-- DASHBOARD CARDS --}}
        <div class="row g-4">

            {{-- PROFILE --}}
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">

                    <div class="card-body text-center p-4">

                        <div class="icon-box bg-dark text-white mx-auto mb-3">
                            <i class="bi bi-person-circle"></i>
                        </div>

                        <h4 class="fw-bold">
                            Profile
                        </h4>

                        <p class="text-muted">
                            View and manage your personal information.
                        </p>

                        <a href="/employee/profile"
                           class="btn btn-dark rounded-pill px-4">
                            View Profile
                        </a>

                    </div>

                </div>

            </div>

            {{-- ATTENDANCE --}}
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">

                    <div class="card-body text-center p-4">

                        <div class="icon-box bg-primary text-white mx-auto mb-3">
                            <i class="bi bi-calendar-check"></i>
                        </div>

                        <h4 class="fw-bold">
                            Attendance
                        </h4>

                        <h1 class="fw-bold text-primary mb-2">
                            {{ $attendanceCount }}
                        </h1>

                        <p class="text-muted">
                            Total attendance records.
                        </p>

                        <a href="/employee/attendance"
                           class="btn btn-primary rounded-pill px-4">
                            Check Attendance
                        </a>

                    </div>

                </div>

            </div>

            {{-- DAILY WORK --}}
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">

                    <div class="card-body text-center p-4">

                        <div class="icon-box bg-success text-white mx-auto mb-3">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>

                        <h4 class="fw-bold">
                            Daily Work
                        </h4>

                        <p class="text-muted">
                            Manage and track your assigned work.
                        </p>

                        <a href="/employee/daily-work"
                           class="btn btn-success rounded-pill px-4">
                            View Work
                        </a>

                    </div>

                </div>

            </div>

            {{-- SALARY --}}
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">

                    <div class="card-body text-center p-4">

                        <div class="icon-box bg-warning text-dark mx-auto mb-3">
                            <i class="bi bi-cash-stack"></i>
                        </div>

                        <h4 class="fw-bold">
                            Salary
                        </h4>

                        <h2 class="fw-bold text-warning">
                            ₹ {{ $totalSalary }}
                        </h2>

                        <p class="text-muted">
                            Check your salary details.
                        </p>

                        <a href="/employee/salary"
                           class="btn btn-warning rounded-pill px-4">
                            View Salary
                        </a>

                    </div>

                </div>

            </div>

            {{-- PERFORMANCE --}}
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">

                    <div class="card-body text-center p-4">

                        <div class="icon-box bg-info text-white mx-auto mb-3">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>

                        <h4 class="fw-bold">
                            Performance
                        </h4>

                        <h2 class="fw-bold text-info">
                            {{ $performance }}
                        </h2>

                        <p class="text-muted">
                            View your performance analytics.
                        </p>

                        <a href="/employee/performance"
                           class="btn btn-info rounded-pill px-4 text-white">
                            View Performance
                        </a>

                    </div>

                </div>

            </div>

            {{-- LEAVE --}}
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 dashboard-card">

                    <div class="card-body text-center p-4">

                        <div class="icon-box bg-danger text-white mx-auto mb-3">
                            <i class="bi bi-airplane-fill"></i>
                        </div>

                        <h4 class="fw-bold">
                            Leave
                        </h4>

                        <h1 class="fw-bold text-danger mb-2">
                            {{ $leaveCount }}
                        </h1>

                        <p class="text-muted">
                            Manage your leave requests.
                        </p>

                        <a href="/employee/leave"
                           class="btn btn-danger rounded-pill px-4">
                            Apply Leave
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- CUSTOM CSS --}}
    <style>

        .dashboard-card{
            transition: all 0.3s ease;
        }

        .dashboard-card:hover{
            transform: translateY(-8px);
        }

        .icon-box{
            width: 75px;
            height: 75px;
            border-radius: 50%;
            font-size: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style>

@endsection
