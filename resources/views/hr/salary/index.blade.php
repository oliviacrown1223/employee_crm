@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="fw-bold text-dark mb-1">

                    Salary & Payroll Management

                </h2>

                <p class="text-muted mb-0">

                    Manage employee payroll, salary slips & payment records

                </p>

            </div>

            <a href="{{ route('hr.salary.create') }}"
               class="btn btn-primary rounded-3 shadow-sm px-4 py-2">

                <i class="bi bi-plus-circle-fill me-2"></i>

                Generate Salary

            </a>

        </div>



        <!-- TOP CARDS -->
        <div class="row g-4 mb-4">

            <!-- TOTAL PAYROLL -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Total Payroll

                                </p>

                                <h3 class="fw-bold text-dark mb-0">

                                    ₹{{ number_format($salaries->sum('net_salary')) }}

                                </h3>

                            </div>

                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:65px;height:65px;">

                                <i class="bi bi-wallet2 fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- TOTAL EMPLOYEE -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Employees

                                </p>

                                <h3 class="fw-bold text-dark mb-0">

                                    {{ $salaries->count() }}

                                </h3>

                            </div>

                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:65px;height:65px;">

                                <i class="bi bi-people-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- PAID -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Paid Salary

                                </p>

                                <h3 class="fw-bold text-success mb-0">

                                    {{ $salaries->where('payment_status','Paid')->count() }}

                                </h3>

                            </div>

                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:65px;height:65px;">

                                <i class="bi bi-check-circle-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- PENDING -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Pending

                                </p>

                                <h3 class="fw-bold text-warning mb-0">

                                    {{ $salaries->where('payment_status','Pending')->count() }}

                                </h3>

                            </div>

                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:65px;height:65px;">

                                <i class="bi bi-clock-history fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- MAIN TABLE CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- CARD HEADER -->
            <div class="card-header bg-white border-0 p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h4 class="fw-bold mb-1">

                            Payroll Records

                        </h4>

                        <p class="text-muted mb-0">

                            Complete employee salary management system

                        </p>

                    </div>

                    <div class="d-flex gap-2">

                        <!-- FILTER -->
                        <button class="btn btn-light border rounded-3 shadow-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#filterModal">

                            <i class="bi bi-funnel-fill me-2"></i>

                            Filter

                        </button>



                        <!-- EXPORT -->
                        <a href="{{ route('hr.salary.export') }}"
                           class="btn btn-dark rounded-3 shadow-sm">

                            <i class="bi bi-download me-2"></i>

                            Export

                        </a>

                    </div>

                </div>

            </div>



            <!-- TABLE -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle table-hover mb-0">

                        <thead class="table-light">

                        <tr>

                            <th class="px-4 py-3">

                                Employee

                            </th>

                            <th class="py-3">

                                Month

                            </th>

                            <th class="py-3">

                                Basic

                            </th>

                            <th class="py-3">

                                Bonus

                            </th>

                            <th class="py-3">

                                Deduction

                            </th>

                            <th class="py-3">

                                Net Salary

                            </th>

                            <th class="py-3">

                                Status

                            </th>

                            <th class="text-center py-3"
                                width="260">

                                Actions

                            </th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($salaries as $salary)

                            <tr>

                                <!-- EMPLOYEE -->
                                <td class="px-4">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                             style="width:45px;height:45px;">

                                            {{ strtoupper(substr($salary->employee->name,0,1)) }}

                                        </div>

                                        <div>

                                            <h6 class="fw-bold mb-0">

                                                {{ $salary->employee->name }}

                                            </h6>

                                            <small class="text-muted">

                                                Employee Payroll

                                            </small>

                                        </div>

                                    </div>

                                </td>



                                <!-- MONTH -->
                                <td>

                                    <span class="fw-semibold">

                                        {{ $salary->salary_month }}

                                    </span>

                                </td>



                                <!-- BASIC -->
                                <td class="fw-semibold">

                                    ₹{{ number_format($salary->basic_salary) }}

                                </td>



                                <!-- BONUS -->
                                <td class="text-success fw-bold">

                                    ₹{{ number_format($salary->bonus) }}

                                </td>



                                <!-- DEDUCTION -->
                                <td class="text-danger fw-bold">

                                    ₹{{ number_format($salary->deduction) }}

                                </td>



                                <!-- NET -->
                                <td>

                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">

                                        ₹{{ number_format($salary->net_salary) }}

                                    </span>

                                </td>



                                <!-- STATUS -->
                                <td>

                                    @if($salary->payment_status == 'Paid')

                                        <span class="badge bg-success px-3 py-2 rounded-pill">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            Paid

                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">

                                            <i class="bi bi-clock-fill me-1"></i>

                                            Pending

                                        </span>

                                    @endif

                                </td>



                                <!-- ACTION -->
                                <td>

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        @if(auth()->user()->can('salary.view.all'))

                                            <a href="{{ route('hr.salary.show', $salary->id) }}"
                                               class="btn btn-info btn-sm rounded-3 shadow-sm">

                                                <i class="bi bi-eye-fill"></i>

                                            </a>

                                        @else

                                            <button class="btn btn-secondary btn-sm rounded-3"
                                                    disabled>

                                                <i class="bi bi-eye-fill"></i>

                                            </button>

                                        @endif



                                        @if(auth()->user()->can('salary.manage.all'))

                                            <a href="{{ route('hr.salary.edit', $salary->id) }}"
                                               class="btn btn-warning btn-sm rounded-3 shadow-sm">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                        @else

                                            <button class="btn btn-secondary btn-sm rounded-3"
                                                    disabled>

                                                <i class="bi bi-pencil-square"></i>

                                            </button>

                                        @endif



                                        <a href="{{ route('hr.salary.download', $salary->id) }}"
                                           class="btn btn-dark btn-sm rounded-3 shadow-sm">

                                            <i class="bi bi-download"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center py-5">

                                    <div class="d-flex flex-column align-items-center">

                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                             style="width:80px;height:80px;">

                                            <i class="bi bi-wallet2 text-muted fs-1"></i>

                                        </div>

                                        <h5 class="fw-bold text-dark">

                                            No Salary Records Found

                                        </h5>

                                        <p class="text-muted mb-0">

                                            Generate employee salary to display payroll records.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- FILTER MODAL -->
            <div class="modal fade"
                 id="filterModal"
                 tabindex="-1">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content border-0 rounded-4 shadow-lg">

                        <div class="modal-header border-0">

                            <h5 class="fw-bold mb-0">

                                Filter Salary Records

                            </h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"></button>

                        </div>

                        <form method="GET"
                              action="{{ route('hr.salary.index') }}">

                            <div class="modal-body">

                                <!-- MONTH -->
                                <div class="mb-3">
                                    <!-- MONTH -->
                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">

                                            Salary Month

                                        </label>

                                        <input type="month"
                                               name="salary_month"
                                               class="form-control rounded-3 shadow-sm"
                                               value="{{ request('salary_month') }}">

                                    </div>



                                    <!-- STATUS -->
                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">

                                            Payment Status

                                        </label>

                                        <select name="payment_status"
                                                class="form-select rounded-3 shadow-sm">

                                            <option value="">
                                                Select Status
                                            </option>

                                            <option value="Paid"
                                                {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>

                                                Paid

                                            </option>

                                            <option value="Pending"
                                                {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>

                                                Pending

                                            </option>

                                        </select>

                                    </div>

                            </div>

                            <div class="modal-footer border-0">

                                <button type="button"
                                        class="btn btn-light border rounded-3"
                                        data-bs-dismiss="modal">

                                    Close

                                </button>

                                <button type="submit"
                                        class="btn btn-primary rounded-3 px-4">

                                    Apply Filter

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <!-- PAGINATION -->
            <div class="card-footer bg-white border-0 py-3">

                {{ $salaries->links() }}

            </div>

        </div>

    </div>

@endsection
