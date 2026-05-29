@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-0">

                    Salary Details

                </h2>

                <p class="text-muted">

                    Employee Payroll Information

                </p>

            </div>

            <a href="{{ route('superadmin.salaries.index') }}"
               class="btn btn-dark rounded-3">

                Back

            </a>

        </div>

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <div class="border rounded-4 p-4 h-100">

                            <h6 class="text-muted mb-3">

                                Employee Name

                            </h6>

                            <h4 class="fw-bold">

                                {{ $salary->employee->name }}

                            </h4>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="border rounded-4 p-4 h-100">

                            <h6 class="text-muted mb-3">

                                Salary Month

                            </h6>

                            <h4 class="fw-bold">

                                {{ $salary->salary_month }}

                            </h4>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="border rounded-4 p-4">

                            <h6 class="text-muted">

                                Basic Salary

                            </h6>

                            <h4 class="fw-bold text-primary">

                                ₹{{ number_format($salary->basic_salary, 2) }}

                            </h4>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="border rounded-4 p-4">

                            <h6 class="text-muted">

                                Bonus

                            </h6>

                            <h4 class="fw-bold text-success">

                                ₹{{ number_format($salary->bonus, 2) }}

                            </h4>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="border rounded-4 p-4">

                            <h6 class="text-muted">

                                Deduction

                            </h6>

                            <h4 class="fw-bold text-danger">

                                ₹{{ number_format($salary->deduction, 2) }}

                            </h4>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="border rounded-4 p-4">

                            <h6 class="text-muted">

                                Net Salary

                            </h6>

                            <h4 class="fw-bold text-dark">

                                ₹{{ number_format($salary->net_salary, 2) }}

                            </h4>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="border rounded-4 p-4">

                            <h6 class="text-muted mb-3">

                                Payment Status

                            </h6>

                            @if($salary->payment_status == 'Paid')

                                <span class="badge bg-success px-4 py-2">

                                Paid

                            </span>

                            @else

                                <span class="badge bg-warning text-dark px-4 py-2">

                                Pending

                            </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
