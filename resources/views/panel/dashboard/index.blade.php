@extends('layouts.admin')

@section('content')

    <div class="container-fluid py-4 dashboard-page">

        {{-- HEADER --}}
        <div class="dashboard-hero mb-4">

            <div>
            <span class="dashboard-badge">
                <i class="bi bi-speedometer2 me-1"></i>
                CRM Dashboard
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Dashboard
                </h2>

                <p class="mb-0 opacity-75">
                    Welcome back, {{ auth()->user()->name }}
                </p>
            </div>

            <div class="dashboard-hero-icon">
                <i class="bi bi-speedometer2"></i>
            </div>

        </div>

        {{-- ROLE ALERTS --}}
        @role('super-admin')
        <div class="dashboard-role-alert role-primary">
            <i class="bi bi-shield-lock-fill me-2"></i>
            You are logged in as Super Admin.
        </div>
        @endrole

        @role('hr')
        <div class="dashboard-role-alert role-success">
            <i class="bi bi-person-badge-fill me-2"></i>
            You are logged in as HR.
        </div>
        @endrole

        @role('manager')
        <div class="dashboard-role-alert role-warning">
            <i class="bi bi-people-fill me-2"></i>
            You are logged in as Manager.
        </div>
        @endrole

        @role('employee')
        <div class="dashboard-role-alert role-info">
            <i class="bi bi-person-circle me-2"></i>
            You are logged in as Employee.
        </div>
        @endrole

        {{-- SUMMARY CARDS --}}
        <div class="row g-4 mt-1">

            @hasanyrole('super-admin|hr')
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('employees.index') }}" class="text-decoration-none">
                    <div class="dashboard-stat-card stat-blue">
                        <div>
                            <small>Total Employees</small>
                            <h2>{{ $totalEmployees }}</h2>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endhasanyrole

            @hasanyrole('super-admin|hr|manager')
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('attendance.index') }}" class="text-decoration-none">
                    <div class="dashboard-stat-card stat-green">
                        <div>
                            <small>Present Today</small>
                            <h2>{{ $presentToday }}</h2>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endhasanyrole

            @role('super-admin')
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('users.index') }}" class="text-decoration-none">
                    <div class="dashboard-stat-card stat-orange">
                        <div>
                            <small>Total Users</small>
                            <h2>{{ $totalUsers }}</h2>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endrole

            @hasanyrole('super-admin|hr')
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('leave.index') }}" class="text-decoration-none">
                    <div class="dashboard-stat-card stat-red">
                        <div>
                            <small>Pending Leaves</small>
                            <h2>{{ $pendingLeaves }}</h2>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endhasanyrole

        </div>

        {{-- EMPLOYEE PROFILE --}}
        @role('employee')
        <div class="dashboard-card mt-4">

            <div class="dashboard-card-header">
                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-person-circle me-2"></i>
                        My Profile
                    </h5>
                    <small class="text-muted">
                        Personal employee information
                    </small>
                </div>
            </div>

            <div class="dashboard-card-body">

                @if($myProfile)

                    <div class="row g-4">

                        <div class="col-md-6">
                            <div class="profile-info-box">
                                <small>Name</small>
                                <h5>{{ $myProfile->name }}</h5>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-info-box">
                                <small>Email</small>
                                <h5>{{ $myProfile->email }}</h5>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-info-box">
                                <small>Department</small>
                                <h5>{{ $myProfile->department ?? '-' }}</h5>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-info-box">
                                <small>Designation</small>
                                <h5>{{ $myProfile->designation ?? '-' }}</h5>
                            </div>
                        </div>

                    </div>

                @else

                    <div class="text-center py-5">
                        <i class="bi bi-person-x display-4 text-muted"></i>
                        <p class="text-muted mb-0 mt-2">
                            Profile not found.
                        </p>
                    </div>

                @endif

            </div>

        </div>
        @endrole

        {{-- LATEST EMPLOYEES --}}
        @hasanyrole('super-admin|hr')
        <div class="dashboard-card mt-4">

            <div class="dashboard-card-header">

                <div>
                    <h5 class="fw-bold mb-1">
                        Latest Employees
                    </h5>

                    <small class="text-muted">
                        Recently added employees
                    </small>
                </div>

                <span class="dashboard-count-pill">
                {{ $latestEmployees->count() }}
            </span>

            </div>

            <div class="table-responsive">

                <table class="table dashboard-table align-middle mb-0">

                    <thead>
                    <tr>
                        <th class="ps-4 py-3">Name</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Department</th>
                        <th class="py-3">Designation</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($latestEmployees as $employee)

                        <tr>
                            <td class="ps-4 fw-semibold">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="dashboard-avatar">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        {{ $employee->name }}
                                    </div>
                                </div>
                            </td>

                            <td>{{ $employee->email }}</td>

                            <td>
                            <span class="dashboard-soft-pill">
                                {{ $employee->department ?? '-' }}
                            </span>
                            </td>

                            <td>
                            <span class="dashboard-primary-pill">
                                {{ $employee->designation ?? '-' }}
                            </span>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                <i class="bi bi-inbox display-5 d-block mb-2"></i>
                                No employees found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endhasanyrole
    </div>
@endsection
