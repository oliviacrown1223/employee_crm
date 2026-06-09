@extends('layouts.admin')

@section('page-title', 'Salary Details')

@section('content')

    <div class="container-fluid py-4 salary-show-page">

        <!-- HEADER -->
        <div class="salary-show-header mb-4">

            <div>

            <span class="salary-show-badge">
                <i class="bi bi-wallet2 me-1"></i>
                Payroll Module
            </span>

                <h2 class="fw-bold mt-3 mb-1">
                    Salary Details
                </h2>

                <p class="mb-0 opacity-75">
                    Employee Payroll Information
                </p>

            </div>

            <div class="d-flex gap-2 flex-wrap">

                <a href="{{ route('salary.payslip', $salary->id) }}"
                   class="btn btn-success rounded-pill px-4 shadow-sm">

                    <i class="bi bi-download me-1"></i>
                    Download Payslip

                </a>

                <a href="{{ route('salary.index') }}"
                   class="btn btn-light rounded-pill px-4 shadow-sm">

                    <i class="bi bi-arrow-left me-1"></i>
                    Back

                </a>

            </div>

        </div>

        <div class="row g-4">

            <!-- Employee -->
            <div class="col-md-6">

                <div class="salary-info-card">

                    <small>Employee Name</small>

                    <h3 class="fw-bold mt-2">
                        {{ $salary->employee->name }}
                    </h3>

                    <div class="salary-card-icon bg-primary-subtle text-primary">
                        <i class="bi bi-person"></i>
                    </div>

                </div>

            </div>

            <!-- Month -->
            <div class="col-md-6">

                <div class="salary-info-card">

                    <small>Salary Month</small>

                    <h3 class="fw-bold mt-2">
                        {{ $salary->salary_month }}
                    </h3>

                    <div class="salary-card-icon bg-success-subtle text-success">
                        <i class="bi bi-calendar-month"></i>
                    </div>

                </div>

            </div>

            <!-- Basic -->
            <div class="col-md-3">

                <div class="salary-stat-box salary-basic">

                    <small>Basic Salary</small>

                    <h4>
                        ₹{{ number_format($salary->basic_salary,2) }}
                    </h4>

                </div>

            </div>

            <!-- Bonus -->
            <div class="col-md-3">

                <div class="salary-stat-box salary-bonus">

                    <small>Bonus</small>

                    <h4>
                        ₹{{ number_format($salary->bonus,2) }}
                    </h4>

                </div>

            </div>

            <!-- Deduction -->
            <div class="col-md-3">

                <div class="salary-stat-box salary-deduction">

                    <small>Deduction</small>

                    <h4>
                        ₹{{ number_format($salary->deduction,2) }}
                    </h4>

                </div>

            </div>

            <!-- Net Salary -->
            <div class="col-md-3">

                <div class="salary-stat-box salary-net">

                    <small>Net Salary</small>

                    <h4>
                        ₹{{ number_format($salary->net_salary,2) }}
                    </h4>

                </div>

            </div>

            <!-- Payment Status -->
            <div class="col-12">

                <div class="salary-status-card">

                    <div>

                        <h5 class="fw-bold mb-2">
                            Payment Status
                        </h5>

                        <small class="text-muted">
                            Current payroll payment information
                        </small>

                    </div>

                    <div>

                        @if($salary->payment_status == 'Paid')

                            <span class="badge bg-success px-4 py-3 rounded-pill fs-6">
                            <i class="bi bi-check-circle me-1"></i>
                            Paid
                        </span>

                        @else

                            <span class="badge bg-warning text-dark px-4 py-3 rounded-pill fs-6">
                            <i class="bi bi-clock-history me-1"></i>
                            Pending
                        </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
