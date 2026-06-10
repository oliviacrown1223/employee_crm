    @extends('layouts.admin')

    @section('page-title', 'Reports')

    @section('content')

        <div class="container-fluid py-4">

            <div class="report-hero mb-4">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div>
                            <span class="report-badge">
        <i class="bi bi-bar-chart-fill me-1"></i>
        Reports Module
    </span>
                            <h2 class="fw-bold mt-3 mb-1 text-white">
                                Reports & Analytics
                            </h2>

                            <p class="text-muted mb-0">
                                {{ $reportTitle ?? 'Advanced system insights, reports and business analytics' }}
                            </p>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">


                            @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('report.export.excel'))
                                <a href="{{ url('/reports/export/excel') }}"
                                   class="btn btn-success px-4 py-2 rounded-3 shadow-sm">

                                    <i class="bi bi-file-earmark-excel-fill me-2"></i>
                                    Export Excel

                                </a>
                            @endif

                            @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('report.export.pdf'))
                                <a href="{{ url('/reports/export/pdf') }}"
                                   class="btn btn-danger px-4 py-2 rounded-3 shadow-sm">

                                    <i class="bi bi-file-earmark-pdf-fill me-2"></i>
                                    Export PDF

                                </a>
                            @endif


                                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('report.print'))
                                    <button onclick="printReport()"
                                            class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">
                                        <i class="bi bi-printer-fill me-2"></i>
                                        Print Report
                                    </button>
                                @endif

                        </div>

                    </div>

                </div>

            </div>

            <div id="printSection">

                <div class="row g-4">

                    <div class="col-xl-4 col-md-6">

                        <div class="card report-stat-card report-blue h-100">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>
                                        <p class="text-muted fw-semibold mb-2">
                                            @role('manager')
                                            Team Employees
                                            @else
                                                Employee Reports
                                                @endrole
                                        </p>

                                        <h1 class="fw-bold text-primary mb-0">
                                            {{ $employees }}
                                        </h1>
                                    </div>

                                    <div class="report-icon">
                                        <i class="bi bi-people-fill text-primary fs-1"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>





                    <div class="col-xl-4 col-md-6">

                        <div class="card report-stat-card report-green h-100"
                             style="cursor:pointer"
                             data-bs-toggle="modal"
                             data-bs-target="#attendanceReportModal">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>
                                        <p class="text-muted fw-semibold mb-2">
                                            Attendance Reports
                                        </p>

                                        <h1 class="fw-bold text-success mb-0">
                                            {{ $attendance }}
                                        </h1>
                                    </div>

                                    <div class="report-icon">
                                        <i class="bi bi-calendar-check-fill text-success fs-1"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>




                    @hasanyrole('super-admin|hr')
                    <div class="col-xl-4 col-md-6">

                        <div class="card report-stat-card report-orange h-100">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>
                                        <p class="text-muted fw-semibold mb-2">
                                           Paid Salary
                                        </p>

                                        <h1 class="fw-bold text-warning mb-0">
                                            ₹ {{ number_format($salary, 2) }}
                                        </h1>
                                    </div>

                                    <div class="report-icon">
                                        <i class="bi bi-cash-stack text-warning fs-1"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    @endhasanyrole

                    <div class="col-xl-4 col-md-6">

                        <div class="card report-stat-card report-cyan h-100">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>
                                        <p class="text-muted fw-semibold mb-2">
                                            Daily Work Reports
                                        </p>

                                        <h1 class="fw-bold text-info mb-0">
                                            {{ $dailyWorks }}
                                        </h1>
                                    </div>

                                    <div class="report-icon">
                                        <i class="bi bi-list-task text-info fs-1"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-4 col-md-6">

                        <div class="card report-stat-card report-red h-100">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>
                                        <p class="text-muted fw-semibold mb-2">
                                            Performance Reports
                                        </p>

                                        <h1 class="fw-bold text-danger mb-0">
                                            {{ $performances }}
                                        </h1>
                                    </div>

                                    <div class="report-icon">
                                        <i class="bi bi-graph-up-arrow text-danger fs-1"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    @hasanyrole('super-admin|hr')
                    <div class="col-xl-4 col-md-6">

                        <div class="card report-stat-card report-gray h-100">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>
                                        <p class="text-muted fw-semibold mb-2">
                                            Leave Reports
                                        </p>

                                        <h1 class="fw-bold text-secondary mb-0">
                                            {{ $leaves }}
                                        </h1>
                                    </div>

                                    <div class="report-icon">
                                        <i class="bi bi-airplane-fill text-secondary fs-1"></i>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    @endhasanyrole

                </div>

                <div class="card report-table-card mt-5">

                    <div class="report-table-header">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h4 class="fw-bold mb-1">
                                    System Analytics
                                </h4>

                                <p class="mb-0 text-light">
                                    Complete analytics and reports overview
                                </p>
                            </div>

                            <span class="badge bg-light text-dark px-4 py-2 rounded-pill fw-semibold">
                            Live Analytics
                        </span>

                        </div>

                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table align-middle mb-0">

                                <thead class="table-light">
                                <tr>
                                    <th class="ps-4 py-3">Module</th>
                                    <th class="py-3">Total</th>
                                    <th class="py-3">Status</th>
                                    <th class="pe-4 py-3 text-end">Progress</th>
                                </tr>
                                </thead>

                                <tbody>

                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-report">
                                                <i class="bi bi-people-fill text-primary"></i>
                                            </div>

                                            <div>
                                                <h6 class="mb-0 fw-bold">Employees</h6>
                                                <small class="text-muted">Employee management reports</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-5">{{ $employees }}</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Active</span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="progress">
                                            <div class="progress-bar w90 bg-success"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-report">
                                                <i class="bi bi-calendar-check-fill text-success"></i>
                                            </div>

                                            <div>
                                                <h6 class="mb-0 fw-bold">Attendance</h6>
                                                <small class="text-muted">Attendance system reports</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-5">{{ $attendance }}</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">Updated</span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="progress">
                                            <div class="progress-bar w95 bg-primary"></div>
                                        </div>
                                    </td>
                                </tr>

                                @hasanyrole('super-admin|hr')
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-report">
                                                <i class="bi bi-cash-stack text-warning"></i>
                                            </div>

                                            <div>
                                                <h6 class="mb-0 fw-bold">Salary</h6>
                                                <small class="text-muted">Salary & payroll reports</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-5">
                                            ₹ {{ number_format($salary, 0) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            Paid
                                        </span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="progress">
                                            <div class="progress-bar w85 bg-warning"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endhasanyrole

                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-report">
                                                <i class="bi bi-list-task text-info"></i>
                                            </div>

                                            <div>
                                                <h6 class="mb-0 fw-bold">Daily Work</h6>
                                                <small class="text-muted">Daily task reports</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-5">{{ $dailyWorks }}</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-info px-3 py-2 rounded-pill">Updated</span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="progress">
                                            <div class="progress-bar w75 bg-info"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-report">
                                                <i class="bi bi-graph-up-arrow text-danger"></i>
                                            </div>

                                            <div>
                                                <h6 class="mb-0 fw-bold">Performance</h6>
                                                <small class="text-muted">Employee performance reports</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-5">{{ $performances }}</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Generated</span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="progress">
                                            <div class="progress-bar w65 bg-danger"></div>
                                        </div>
                                    </td>
                                </tr>

                                @hasanyrole('super-admin|hr')
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-report">
                                                <i class="bi bi-airplane-fill text-secondary"></i>
                                            </div>

                                            <div>
                                                <h6 class="mb-0 fw-bold">Leaves</h6>
                                                <small class="text-muted">Leave management reports</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold fs-5">{{ $leaves }}</span>
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">Active</span>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="progress">
                                            <div class="progress-bar w55 bg-secondary"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endhasanyrole

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="modal fade" id="attendanceReportModal" tabindex="-1">

            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content rounded-4 border-0 shadow-lg">

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-calendar-check me-2"></i>
                            Attendance Reports
                        </h5>

                        <button type="button"
                                class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-0">
                        <div class="p-3 border-bottom bg-light">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <input type="text"
                                           id="attendanceEmployeeSearch"
                                           class="form-control rounded-pill"
                                           placeholder="Search employee name...">
                                </div>

                                <div class="col-md-4">
                                    <input type="date"
                                           id="attendanceDateSearch"
                                           class="form-control rounded-pill">
                                </div>

                                <div class="col-md-2">
                                    <button type="button"
                                            id="attendanceResetBtn"
                                            class="btn btn-secondary w-100 rounded-pill">
                                        Reset
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive attendance-modal-scroll">

                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                </tr>
                                </thead>

                                <tbody id="attendanceReportTable">
                                @include('panel.reports.partials.attendance-table')
                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <script>
            function printReport()
            {
                let printContents =
                    document.getElementById('printSection').innerHTML;

                let originalContents =
                    document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;

                location.reload();
            }

            document.addEventListener('DOMContentLoaded', function () {

                const employeeInput = document.getElementById('attendanceEmployeeSearch');
                const dateInput = document.getElementById('attendanceDateSearch');
                const tableBody = document.getElementById('attendanceReportTable');
                const resetBtn = document.getElementById('attendanceResetBtn');

                function liveSearchAttendance() {

                    let employee = employeeInput.value;
                    let date = dateInput.value;

                    fetch("{{ route('reports.attendance.search') }}?employee=" + encodeURIComponent(employee) + "&date=" + encodeURIComponent(date), {
                        method: "GET",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                        .then(response => response.text())
                        .then(data => {
                            tableBody.innerHTML = data;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }

                employeeInput.addEventListener('keyup', liveSearchAttendance);
                dateInput.addEventListener('change', liveSearchAttendance);

                resetBtn.addEventListener('click', function () {
                    employeeInput.value = '';
                    dateInput.value = '';
                    liveSearchAttendance();
                });

            });
        </script>
    @endsection
