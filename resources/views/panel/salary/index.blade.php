@extends('layouts.admin')

@section('page-title', 'Salary & Payroll')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">
                    @role('employee')
                    My Salary
                    @else
                        Salary & Payroll
                        @endrole
                </h2>

                <p class="text-muted">
                    Employee Salary Management
                </p>
            </div>

            <div class="d-flex gap-2">




                @if(auth()->user()->hasAnyRole(['super-admin'])
                || auth()->user()->can('salary.export.all'))
                <a href="{{ route('salary.export') }}"
                   class="btn btn-success rounded-3">
                    Export Excel
                </a>
                @endif
                @if(auth()->user()->hasAnyRole(['super-admin'])
              || auth()->user()->can('salary.generate.all'))
                <a href="{{ route('salary.create') }}"
                   class="btn btn-primary rounded-3">
                    Generate Salary
                </a>
                @endif

                @if(auth()->user()->hasAnyRole(['super-admin', 'hr', 'manager']) || auth()->user()->can('salary.payslip.download.self'))
                <button type="button"
                        class="btn btn-dark rounded-3"
                        data-bs-toggle="modal"
                        data-bs-target="#payslipModal">
                    Download Payslip
                </button>
                @endif
            </div>

        </div>

        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h6 class="text-muted">Total Payroll</h6>
                        <h3 class="fw-bold text-primary">
                            ₹{{ number_format($totalSalary, 2) }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h6 class="text-muted">Paid Salary</h6>
                        <h3 class="fw-bold text-success">
                            ₹{{ number_format($totalPaid, 2) }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h6 class="text-muted">Pending Salary</h6>
                        <h3 class="fw-bold text-danger">
                            ₹{{ number_format($totalPending, 2) }}
                        </h3>
                    </div>
                </div>
            </div>

        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <div class="row g-3">

                    @hasanyrole('super-admin|hr')
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
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
                        <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-calendar-month"></i>
                        </span>

                            <input type="month"
                                   id="month"
                                   class="form-control">
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div id="salaryTable">
                    @include('panel.salary.table')
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade"
         id="payslipModal"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 rounded-4">

                <div class="modal-header">
                    <h5 class="modal-title">Download Payslip</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <p class="text-muted">
                        Select employee salary payslip.
                    </p>

                    <select class="form-select mb-3"
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
                            class="btn btn-dark w-100">
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
