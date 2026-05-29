@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        {{-- PAGE HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Super Admin Dashboard
                </h2>

                <p class="text-muted mb-0">
                    Manage employees, salaries, attendance and company activities.
                </p>

            </div>

            <div>

            <span class="badge bg-dark fs-6 px-4 py-2 rounded-pill">
                {{ now()->format('d M Y') }}
            </span>

            </div>

        </div>

        {{-- TOP CARDS --}}
        <div class="row g-4 mb-4">

            {{-- TOTAL EMPLOYEES --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 dashboard-card h-100">

                    <div class="card-body">

                        <a href="{{ route('employees.index') }}" class="text-decoration-none text-dark">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <p class="text-muted mb-2">
                                        Total Employees
                                    </p>

                                    <h2 class="fw-bold">
                                        {{ $totalEmployees }}
                                    </h2>

                                </div>

                                <div class="icon-box bg-primary text-white">
                                    <i class="bi bi-people-fill"></i>
                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

            {{-- PRESENT TODAY --}}

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 dashboard-card h-100">

                    <div class="card-body">
                        <a href="{{ route('attendance.index') }}" class="text-decoration-none text-dark">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-2">
                                    Present Today
                                </p>

                                <h2 class="fw-bold text-success">
                                    {{ $presentToday }}
                                </h2>

                            </div>

                            <div class="icon-box bg-success text-white">
                                <i class="bi bi-calendar-check-fill"></i>
                            </div>

                        </div>
                        </a>
                    </div>

                </div>

            </div>

            {{-- PENDING TASKS --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 dashboard-card h-100">

                    <a href="{{ route('daily-work.index') }}" class="text-decoration-none text-dark">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <p class="text-muted mb-2">
                                        Pending Tasks
                                    </p>

                                    <h2 class="fw-bold text-warning">
                                        {{ $pendingTasks }}
                                    </h2>

                                </div>

                                <div class="icon-box bg-warning text-dark">
                                    <i class="bi bi-list-task"></i>
                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            </div>

            {{-- SALARY --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 dashboard-card h-100">

                    <div class="card-body">
                        <a href="{{ route('superadmin.salaries.index') }}" class="text-decoration-none text-dark">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-2">
                                   Paid Salary
                                </p>

                                <h4 class="fw-bold text-danger">
                                    ₹ {{ number_format($totalSalary) }}
                                </h4>

                            </div>

                            <div class="icon-box bg-danger text-white">
                                <i class="bi bi-cash-stack"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- EMPLOYEE TABLE --}}
        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4 class="fw-bold mb-1">
                            Latest Employees
                        </h4>

                        <p class="text-muted mb-0">
                            Recently added employee records
                        </p>

                    </div>

                    <a href="{{ route('employees.index') }}"
                       class="btn btn-dark rounded-pill px-4">

                        <i class="bi bi-eye me-1"></i>
                        View All

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                        <tr>

                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Salary</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($employees as $employee)

                            <tr>

                                <td>
                                    #{{ $employee->id }}
                                </td>

                                <td>

                                    <div class="d-flex align-items-center">

                                        <div class="employee-avatar me-2">
                                            {{ strtoupper(substr($employee->name,0,1)) }}
                                        </div>

                                        <div>
                                            <h6 class="mb-0 fw-semibold">
                                                {{ $employee->name }}
                                            </h6>
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    {{ $employee->email }}
                                </td>

                                <td>

                                <span class="badge bg-primary rounded-pill px-3">
                                    {{ $employee->department }}
                                </span>

                                </td>

                                <td class="fw-bold text-success">
                                    ₹ {{ number_format($employee->salary) }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center text-muted py-4">
                                    No Employees Found
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

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
            transform: translateY(-6px);
        }

        .icon-box{
            width: 65px;
            height: 65px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .employee-avatar{
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #212529;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .table td,
        .table th{
            vertical-align: middle;
        }

    </style>

@endsection
