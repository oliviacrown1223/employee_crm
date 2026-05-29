{{-- resources/views/hr/dashboard/index.blade.php --}}

@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-1">HR Dashboard</h3>
                <p class="text-muted mb-0">
                    Welcome Back, HR Manager 👋
                </p>
            </div>

            <div>
            <span class="badge bg-dark p-2">
                {{ now()->format('d M Y') }}
            </span>
            </div>

        </div>

        {{-- Top Cards --}}

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-1">
                                    Total Employees
                                </p>

                                <h2 class="fw-bold">
                                    {{ $totalEmployees }}
                                </h2>

                            </div>

                            <div class="bg-primary text-white rounded-circle p-3">

                                <i class="fas fa-users fa-2x"></i>

                            </div>

                        </div>

                    </div>

                    <div class="bg-primary" style="height: 5px;"></div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-1">
                                    Present Today
                                </p>

                                <h2 class="fw-bold text-success">
                                    {{ $presentEmployees }}
                                </h2>

                            </div>

                            <div class="bg-success text-white rounded-circle p-3">

                                <i class="fas fa-user-check fa-2x"></i>

                            </div>

                        </div>

                    </div>

                    <div class="bg-success" style="height: 5px;"></div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-1">
                                    Employees On Leave
                                </p>

                                <h2 class="fw-bold text-warning">
                                    {{ $leaveEmployees }}
                                </h2>

                            </div>

                            <div class="bg-warning text-white rounded-circle p-3">

                                <i class="fas fa-calendar-times fa-2x"></i>

                            </div>

                        </div>

                    </div>

                    <div class="bg-warning" style="height: 5px;"></div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-1">
                                    Total Salary
                                </p>

                                <h2 class="fw-bold text-danger">
                                    ₹{{ number_format($totalSalary) }}
                                </h2>

                            </div>

                            <div class="bg-danger text-white rounded-circle p-3">

                                <i class="fas fa-money-bill-wave fa-2x"></i>

                            </div>

                        </div>

                    </div>

                    <div class="bg-danger" style="height: 5px;"></div>

                </div>

            </div>

        </div>

        {{-- Quick Access --}}

        <div class="row">

            <div class="col-lg-8 mb-4">

                <div class="card border-0 shadow rounded-4">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold">
                            Quick Access
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-3 mb-3">

                                <a href="{{ route('hr.employees.index') }}"
                                   class="text-decoration-none">

                                    <div class="card border-0 bg-primary text-white rounded-4 shadow-sm">

                                        <div class="card-body text-center">

                                            <i class="fas fa-users fa-2x mb-3"></i>

                                            <h6>Employees</h6>

                                        </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-md-3 mb-3">

                                <a href="{{ route('hr.salary.index') }}"
                                   class="text-decoration-none">

                                    <div class="card border-0 bg-success text-white rounded-4 shadow-sm">

                                        <div class="card-body text-center">

                                            <i class="fas fa-wallet fa-2x mb-3"></i>

                                            <h6>Salary</h6>

                                        </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-md-3 mb-3">

                                <a href="{{ route('hr.attendance.index') }}"
                                   class="text-decoration-none">

                                    <div class="card border-0 bg-warning text-white rounded-4 shadow-sm">

                                        <div class="card-body text-center">

                                            <i class="fas fa-calendar-check fa-2x mb-3"></i>

                                            <h6>Attendance</h6>

                                        </div>

                                    </div>

                                </a>

                            </div>

                            <div class="col-md-3 mb-3">

                                <a href="{{ route('hr.leave.index') }}"
                                   class="text-decoration-none">

                                    <div class="card border-0 bg-danger text-white rounded-4 shadow-sm">

                                        <div class="card-body text-center">

                                            <i class="fas fa-plane-departure fa-2x mb-3"></i>

                                            <h6>Leave</h6>

                                        </div>

                                    </div>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Recent Activity --}}

            <div class="col-lg-4 mb-4">

                <div class="card border-0 shadow rounded-4 h-100">

                    <div class="card-header bg-white border-0 pt-4">

                        <h5 class="fw-bold">
                            Recent Activity
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="d-flex mb-4">

                            <div class="me-3">

                                <div class="bg-success rounded-circle p-2"></div>

                            </div>

                            <div>

                                <h6 class="mb-1">
                                    Attendance Updated
                                </h6>

                                <small class="text-muted">
                                    Today's attendance marked
                                </small>

                            </div>

                        </div>

                        <div class="d-flex mb-4">

                            <div class="me-3">

                                <div class="bg-warning rounded-circle p-2"></div>

                            </div>

                            <div>

                                <h6 class="mb-1">
                                    Leave Request
                                </h6>

                                <small class="text-muted">
                                    New leave application received
                                </small>

                            </div>

                        </div>

                        <div class="d-flex">

                            <div class="me-3">

                                <div class="bg-danger rounded-circle p-2"></div>

                            </div>

                            <div>

                                <h6 class="mb-1">
                                    Salary Generated
                                </h6>

                                <small class="text-muted">
                                    Salary processed successfully
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
