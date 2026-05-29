@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="fw-bold text-dark mb-1">

                    Salary Details

                </h2>

                <p class="text-muted mb-0">

                    Complete employee salary & payroll overview

                </p>

            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('employee.salary.download', $salary->id) }}"
                   class="btn btn-light border shadow-sm rounded-3 px-4">

                    <i class="bi bi-download me-2"></i>

                    Download Slip

                </a>

                <a href="{{ route('employee.salary.index') }}"
                   class="btn btn-dark rounded-3 shadow px-4">

                    <i class="bi bi-arrow-left me-2"></i>

                    Back

                </a>

            </div>

        </div>



        <!-- TOP SUMMARY -->
        <div class="row g-4 mb-4">

            <!-- NET SALARY -->
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Net Salary

                                </p>

                                <h2 class="fw-bold text-primary mb-0">

                                    ₹{{ number_format($salary->net_salary) }}

                                </h2>

                            </div>

                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-wallet2 fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- BONUS -->
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Bonus

                                </p>

                                <h2 class="fw-bold text-success mb-0">

                                    ₹{{ number_format($salary->bonus) }}

                                </h2>

                            </div>

                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-gift-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- DEDUCTION -->
            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Deduction

                                </p>

                                <h2 class="fw-bold text-danger mb-0">

                                    ₹{{ number_format($salary->deduction) }}

                                </h2>

                            </div>

                            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-cash-coin fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- CARD HEADER -->
            <div class="card-header bg-white border-0 p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h4 class="fw-bold mb-1">

                            Payroll Information

                        </h4>

                        <p class="text-muted mb-0">

                            Employee salary complete details

                        </p>

                    </div>

                    <div>

                        @if($salary->payment_status == 'Paid')

                            <span class="badge bg-success-subtle text-success px-4 py-3 rounded-pill fw-semibold">

                                <i class="bi bi-check-circle-fill me-2"></i>

                                Salary Paid

                            </span>

                        @else

                            <span class="badge bg-warning-subtle text-warning px-4 py-3 rounded-pill fw-semibold">

                                <i class="bi bi-clock-fill me-2"></i>

                                Payment Pending

                            </span>

                        @endif

                    </div>

                </div>

            </div>



            <!-- TABLE -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <tbody>

                        <!-- EMPLOYEE -->
                        <tr>

                            <th class="bg-light fw-semibold px-4 py-4"
                                width="25%">

                                <i class="bi bi-person-fill text-primary me-2"></i>

                                Employee

                            </th>

                            <td class="fw-semibold text-dark py-4">

                                {{ $salary->employee->name }}

                            </td>

                        </tr>



                        <!-- MONTH -->
                        <tr>

                            <th class="bg-light fw-semibold px-4 py-4">

                                <i class="bi bi-calendar-event-fill text-primary me-2"></i>

                                Salary Month

                            </th>

                            <td class="fw-semibold py-4">

                                {{ $salary->salary_month }}

                            </td>

                        </tr>



                        <!-- BASIC -->
                        <tr>

                            <th class="bg-light fw-semibold px-4 py-4">

                                <i class="bi bi-currency-rupee text-success me-2"></i>

                                Basic Salary

                            </th>

                            <td class="fw-bold text-dark py-4">

                                ₹{{ number_format($salary->basic_salary) }}

                            </td>

                        </tr>



                        <!-- BONUS -->
                        <tr>

                            <th class="bg-light fw-semibold px-4 py-4">

                                <i class="bi bi-gift-fill text-success me-2"></i>

                                Bonus

                            </th>

                            <td class="fw-bold text-success py-4">

                                ₹{{ number_format($salary->bonus) }}

                            </td>

                        </tr>



                        <!-- DEDUCTION -->
                        <tr>

                            <th class="bg-light fw-semibold px-4 py-4">

                                <i class="bi bi-dash-circle-fill text-danger me-2"></i>

                                Deduction

                            </th>

                            <td class="fw-bold text-danger py-4">

                                ₹{{ number_format($salary->deduction) }}

                            </td>

                        </tr>



                        <!-- NET SALARY -->
                        <tr>

                            <th class="bg-light fw-semibold px-4 py-4">

                                <i class="bi bi-wallet-fill text-primary me-2"></i>

                                Net Salary

                            </th>

                            <td class="py-4">

                                <span class="badge bg-primary fs-6 px-4 py-3 rounded-pill">

                                    ₹{{ number_format($salary->net_salary) }}

                                </span>

                            </td>

                        </tr>



                        <!-- PAYMENT STATUS -->
                        <tr>

                            <th class="bg-light fw-semibold px-4 py-4">

                                <i class="bi bi-credit-card-fill text-warning me-2"></i>

                                Payment Status

                            </th>

                            <td class="py-4">

                                @if($salary->payment_status == 'Paid')

                                    <span class="badge bg-success px-4 py-3 rounded-pill">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Paid

                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark px-4 py-3 rounded-pill">

                                        <i class="bi bi-clock-fill me-1"></i>

                                        Pending

                                    </span>

                                @endif

                            </td>

                        </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
