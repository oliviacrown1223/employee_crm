@extends('layouts.admin')

@section('page-title', 'Salary & Payroll')

@section('content')

    <div class="container-fluid py-4 salary-page">

        <div class="salary-hero mb-4">

            <div>
            <span class="salary-hero-badge">
                <i class="bi bi-wallet2 me-1"></i>
                Payroll Module
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    @role('employee')
                    My Salary
                    @else
                        Salary & Payroll
                        @endrole
                </h2>

                <p class="mb-0 opacity-75">
                    Employee Salary Management
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap">

                @if(auth()->user()->hasAnyRole(['super-admin']) || auth()->user()->can('salary.export.all'))
                    <a href="{{ route('salary.export') }}"
                       class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-file-earmark-excel me-1"></i>
                        Export Excel
                    </a>
                @endif

                @if(auth()->user()->hasAnyRole(['super-admin']) || auth()->user()->can('salary.generate.all'))
                    <a href="{{ route('salary.create') }}"
                       class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i>
                        Generate Salary
                    </a>
                @endif

                @if(auth()->user()->hasAnyRole(['super-admin', 'hr', 'manager']) || auth()->user()->can('salary.payslip.download.self'))
                    <button type="button"
                            class="btn btn-dark rounded-pill px-4 fw-semibold shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#payslipModal">
                        <i class="bi bi-download me-1"></i>
                        Download Payslip
                    </button>
                @endif

            </div>

        </div>

        <div class="row g-4 mb-4">

            <div class="col-lg-4 col-md-6">
                <div class="salary-stat-card salary-total">
                    <div>
                        <small>Total Payroll</small>
                        <h3>₹{{ number_format($totalSalary, 2) }}</h3>
                    </div>

                    <div class="salary-stat-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="salary-stat-card salary-paid">
                    <div>
                        <small>Paid Salary</small>
                        <h3>₹{{ number_format($totalPaid, 2) }}</h3>
                    </div>

                    <div class="salary-stat-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="salary-stat-card salary-pending">
                    <div>
                        <small>Pending Salary</small>
                        <h3>₹{{ number_format($totalPending, 2) }}</h3>
                    </div>

                    <div class="salary-stat-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="salary-filter-card mb-4">

            <div class="salary-filter-header">
                <div>
                    <h5 class="fw-bold mb-1">Filter Payroll</h5>
                    <small class="text-muted">Search employee salary records</small>
                </div>
            </div>

            <div class="row g-3">

                @hasanyrole('super-admin|hr')
                <div class="col-md-5">
                    <div class="salary-input-group">
                    <span>
                        <i class="bi bi-search"></i>
                    </span>

                        <input type="text"
                               id="search"
                               class="form-control"
                               placeholder="Search employee...">
                    </div>
                </div>
                @endhasanyrole

                <div class="col-md-3">
                    <div class="salary-input-group">
                    <span>
                        <i class="bi bi-calendar-month"></i>
                    </span>

                        <input type="month"
                               id="month"
                               class="form-control">
                    </div>
                </div>

            </div>

        </div>

        <div class="salary-table-card">

            <div class="salary-table-header">
                <div>
                    <h5 class="fw-bold mb-1">Salary Records</h5>
                    <small class="text-muted">Monthly payroll overview</small>
                </div>
            </div>

            <div id="salaryTable">
                @include('panel.salary.table')
            </div>

        </div>

    </div>

    <div class="modal fade"
         id="payslipModal"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content salary-modal">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">
                        Download Payslip
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <p class="text-muted">
                        Select employee salary payslip.
                    </p>

                    <select class="form-select salary-modal-input mb-3"
                            id="salary_id">

                        <option value="">
                            Choose Salary
                        </option>

                        @foreach($salaries as $salary)
                            <option value="{{ $salary->id }}">
                                {{ $salary->employee->name }}
                                -
                                {{ $salary->salary_month }}
                            </option>
                        @endforeach

                    </select>

                    <button type="button"
                            id="downloadPayslip"
                            class="btn btn-dark w-100 rounded-pill py-2 fw-semibold">
                        <i class="bi bi-download me-1"></i>
                        Download PDF
                    </button>

                </div>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {

            function fetchSalary() {
                $.ajax({
                    url: "{{ route('salary.index') }}",
                    type: "GET",
                    data: {
                        search: $('#search').val(),
                        month: $('#month').val()
                    },
                    success: function (response) {
                        $('#salaryTable').html(response);
                    }
                });
            }

            $(document).on('keyup', '#search', function () {
                fetchSalary();
            });

            $(document).on('change', '#month', function () {
                fetchSalary();
            });

            $(document).on('click', '#openPayslipModal', function () {
                $('#payslipModal').modal('show');
            });

            $(document).on('click', '#downloadPayslip', function () {
                let salaryId = $('#salary_id').val();

                if (salaryId == '') {
                    alert('Please select salary');
                    return;
                }

                window.location.href = '/salary/' + salaryId + '/payslip';
            });
        });
    </script>

@endsection
