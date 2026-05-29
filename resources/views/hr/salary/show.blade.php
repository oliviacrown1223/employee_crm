@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid">

        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header bg-white d-flex justify-content-between align-items-center">

                <h4 class="fw-bold mb-0">
                    Salary Details
                </h4>

                <a href="{{ route('hr.salary.index') }}"
                   class="btn btn-dark">

                    Back

                </a>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <div class="border rounded-4 p-3 h-100">

                            <h6 class="text-muted">
                                Employee Name
                            </h6>

                            <h5 class="fw-bold">
                                {{ $salary->employee->name }}
                            </h5>

                        </div>

                    </div>

                    <div class="col-md-6 mb-4">

                        <div class="border rounded-4 p-3 h-100">

                            <h6 class="text-muted">
                                Salary Month
                            </h6>

                            <h5 class="fw-bold">
                                {{ $salary->salary_month }}
                            </h5>

                        </div>

                    </div>

                    <div class="col-md-3 mb-4">

                        <div class="card border-0 bg-primary text-white rounded-4">

                            <div class="card-body text-center">

                                <h6>
                                    Basic Salary
                                </h6>

                                <h3 class="fw-bold">

                                    ₹{{ number_format($salary->basic_salary, 2) }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 mb-4">

                        <div class="card border-0 bg-success text-white rounded-4">

                            <div class="card-body text-center">

                                <h6>
                                    Bonus
                                </h6>

                                <h3 class="fw-bold">

                                    ₹{{ number_format($salary->bonus, 2) }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 mb-4">

                        <div class="card border-0 bg-danger text-white rounded-4">

                            <div class="card-body text-center">

                                <h6>
                                    Deduction
                                </h6>

                                <h3 class="fw-bold">

                                    ₹{{ number_format($salary->deduction, 2) }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3 mb-4">

                        <div class="card border-0 bg-dark text-white rounded-4">

                            <div class="card-body text-center">

                                <h6>
                                    Net Salary
                                </h6>

                                <h3 class="fw-bold">

                                    ₹{{ number_format($salary->net_salary, 2) }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="border rounded-4 p-4">

                            <div class="row">

                                <div class="col-md-6">

                                    <h6 class="text-muted">
                                        Payment Status
                                    </h6>

                                    <span class="badge bg-success p-2">

                                    {{ $salary->payment_status }}

                                </span>

                                </div>

                                <div class="col-md-6 text-md-end mt-3 mt-md-0">

                                    <a href="{{ route('hr.salary.edit', $salary->id) }}"
                                       class="btn btn-warning">

                                        Edit Salary

                                    </a>

                                    <a href="{{ route('hr.salary.download', $salary->id) }}"
                                       class="btn btn-dark">

                                        Download Payslip

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
