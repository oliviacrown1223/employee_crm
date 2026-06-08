@extends('layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        {{-- HEADER --}}
        <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">

            <div class="card-body bg-primary text-white p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h2 class="fw-bold mb-1">

                            Dashboard

                        </h2>

                        <p class="mb-0 opacity-75">

                            Welcome back, {{ auth()->user()->name }}

                        </p>

                    </div>

                    <div class="text-end">

                        <i class="bi bi-speedometer2 display-4"></i>

                    </div>

                </div>

            </div>

        </div>


        {{-- ROLE ALERTS --}}
        @role('super-admin')

        <div class="alert alert-primary border-0 shadow-sm rounded-4">

            <i class="bi bi-shield-lock-fill me-2"></i>

            You are logged in as Super Admin.

        </div>

        @endrole

        @role('hr')

        <div class="alert alert-success border-0 shadow-sm rounded-4">

            <i class="bi bi-person-badge-fill me-2"></i>

            You are logged in as HR.

        </div>

        @endrole

        @role('manager')

        <div class="alert alert-warning border-0 shadow-sm rounded-4">

            <i class="bi bi-people-fill me-2"></i>

            You are logged in as Manager.

        </div>

        @endrole

        @role('employee')

        <div class="alert alert-info border-0 shadow-sm rounded-4">

            <i class="bi bi-person-circle me-2"></i>

            You are logged in as Employee.

        </div>

        @endrole


        {{-- SUMMARY CARDS --}}
        <div class="row g-4">

            @hasanyrole('super-admin|hr')

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('employees.index') }}"
                   class="text-decoration-none">

                    <div class="card border-0 shadow-lg rounded-4 h-100 hover-card">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <p class="text-muted fw-semibold mb-2">
                                        Total Employees
                                    </p>

                                    <h2 class="fw-bold mb-0 text-dark">
                                        {{ $totalEmployees }}
                                    </h2>

                                </div>

                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box">

                                    <i class="bi bi-people-fill fs-2"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            @endhasanyrole


            @hasanyrole('super-admin|hr|manager')

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('attendance.index') }}"
                   class="text-decoration-none">

                    <div class="card border-0 shadow-lg rounded-4 h-100 hover-card">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <p class="text-muted fw-semibold mb-2">
                                        Present Today
                                    </p>

                                    <h2 class="fw-bold mb-0 text-success">
                                        {{ $presentToday }}
                                    </h2>

                                </div>

                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box">

                                    <i class="bi bi-check-circle-fill fs-2"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            @endhasanyrole


            @role('super-admin')

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('users.index') }}"
                   class="text-decoration-none">

                    <div class="card border-0 shadow-lg rounded-4 h-100 hover-card">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <p class="text-muted fw-semibold mb-2">
                                        Total Users
                                    </p>

                                    <h2 class="fw-bold mb-0 text-warning">
                                        {{ $totalUsers }}
                                    </h2>

                                </div>

                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box">

                                    <i class="bi bi-person-badge-fill fs-2"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            @endrole


            @hasanyrole('super-admin|hr')

            <div class="col-xl-3 col-md-6">

                <a href="{{ route('leave.index') }}"
                   class="text-decoration-none">

                    <div class="card border-0 shadow-lg rounded-4 h-100 hover-card">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <p class="text-muted fw-semibold mb-2">
                                        Pending Leaves
                                    </p>

                                    <h2 class="fw-bold mb-0 text-danger">
                                        {{ $pendingLeaves }}
                                    </h2>

                                </div>

                                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box">

                                    <i class="bi bi-calendar-event-fill fs-2"></i>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            @endhasanyrole

        </div>


        {{-- EMPLOYEE PROFILE --}}
        @role('employee')

        <div class="card border-0 shadow-lg rounded-4 mt-4 overflow-hidden">

            <div class="card-header bg-dark text-white py-3">

                <h5 class="mb-0 fw-bold">

                    <i class="bi bi-person-circle me-2"></i>

                    My Profile

                </h5>

            </div>

            <div class="card-body p-4">

                @if($myProfile)

                    <div class="row g-4">

                        <div class="col-md-6">

                            <div class="border rounded-4 p-3 h-100">

                                <small class="text-muted">

                                    Name

                                </small>

                                <h5 class="fw-bold mb-0">

                                    {{ $myProfile->name }}

                                </h5>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="border rounded-4 p-3 h-100">

                                <small class="text-muted">

                                    Email

                                </small>

                                <h5 class="fw-bold mb-0">

                                    {{ $myProfile->email }}

                                </h5>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="border rounded-4 p-3 h-100">

                                <small class="text-muted">

                                    Department

                                </small>

                                <h5 class="fw-bold mb-0">

                                    {{ $myProfile->department ?? '-' }}

                                </h5>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="border rounded-4 p-3 h-100">

                                <small class="text-muted">

                                    Designation

                                </small>

                                <h5 class="fw-bold mb-0">

                                    {{ $myProfile->designation ?? '-' }}

                                </h5>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="text-center py-4">

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

        <div class="card border-0 shadow-lg rounded-4 mt-4 overflow-hidden">

            <div class="card-header bg-dark text-white py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="fw-bold mb-1">

                            Latest Employees

                        </h5>

                        <small class="opacity-75">

                            Recently added employees

                        </small>

                    </div>

                    <span class="badge bg-primary px-3 py-2 rounded-pill">

                            {{ $latestEmployees->count() }}

                        </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle table-hover mb-0">

                        <thead class="table-light">

                        <tr>

                            <th class="ps-4 py-3">

                                Name

                            </th>

                            <th class="py-3">

                                Email

                            </th>

                            <th class="py-3">

                                Department

                            </th>

                            <th class="py-3">

                                Designation

                            </th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($latestEmployees as $employee)

                            <tr>

                                <td class="ps-4 fw-semibold">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                             style="width:42px;height:42px;">

                                            {{ strtoupper(substr($employee->name, 0, 1)) }}

                                        </div>

                                        <div>

                                            {{ $employee->name }}

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    {{ $employee->email }}

                                </td>

                                <td>

                                        <span class="badge bg-light text-dark border px-3 py-2">

                                            {{ $employee->department ?? '-' }}

                                        </span>

                                </td>

                                <td>

                                        <span class="badge bg-primary-subtle text-primary px-3 py-2">

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

        </div>

        @endhasanyrole

    </div>

@endsection
