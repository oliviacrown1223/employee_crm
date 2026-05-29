@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h2 class="fw-bold mb-1 text-dark">

                            Reports & Analytics

                        </h2>

                        <p class="text-muted mb-0">

                            Advanced system insights, reports and business analytics

                        </p>

                    </div>

                    <!-- ACTION BUTTONS -->

                    <div class="d-flex gap-2 flex-wrap">

                        @can('reports-export')

                            <button class="btn btn-success px-4 py-2 rounded-3 shadow-sm">

                                <i class="bi bi-file-earmark-excel-fill me-2"></i>

                                Export Excel

                            </button>

                            <button class="btn btn-danger px-4 py-2 rounded-3 shadow-sm">

                                <i class="bi bi-file-earmark-pdf-fill me-2"></i>

                                Export PDF

                            </button>

                        @endcan

                            <button onclick="printReport()"
                                    class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">

                                <i class="bi bi-printer-fill me-2"></i>

                                Print Report

                            </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- REPORT CARDS -->
        <div id="printSection">
        <div class="row g-4">

            <!-- EMPLOYEE REPORT -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Employee Reports

                                </p>

                                <h1 class="fw-bold text-primary mb-0">

                                    {{ $employees }}

                                </h1>

                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;">

                                <i class="bi bi-people-fill text-primary fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ATTENDANCE REPORT -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

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

                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;">

                                <i class="bi bi-calendar-check-fill text-success fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- SALARY REPORT -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Salary Reports

                                </p>

                                <h1 class="fw-bold text-warning mb-0">

                                    ₹ {{ number_format($salary, 2) }}

                                </h1>

                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;">

                                <i class="bi bi-cash-stack text-warning fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- DAILY WORK -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

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

                            <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;">

                                <i class="bi bi-list-task text-info fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PERFORMANCE -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

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

                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;">

                                <i class="bi bi-graph-up-arrow text-danger fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- LEAVES -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

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

                            <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;">

                                <i class="bi bi-airplane-fill text-secondary fs-1"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- ANALYTICS TABLE -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mt-5">

            <div class="card-header bg-dark text-white border-0 p-4">

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

                        <!-- EMPLOYEE -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-people-fill text-primary"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">

                                            Employees

                                        </h6>

                                        <small class="text-muted">

                                            Employee management reports

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                            <span class="fw-bold fs-5">

                                {{ $employees }}

                            </span>

                            </td>

                            <td>

                            <span class="badge bg-success px-3 py-2 rounded-pill">

                                Active

                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-success"
                                         style="width:95%;"></div>

                                </div>

                            </td>

                        </tr>

                        <!-- ATTENDANCE -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-calendar-check-fill text-success"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">

                                            Attendance

                                        </h6>

                                        <small class="text-muted">

                                            Attendance system reports

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                            <span class="fw-bold fs-5">

                                {{ $attendance }}

                            </span>

                            </td>

                            <td>

                            <span class="badge bg-primary px-3 py-2 rounded-pill">

                                Updated

                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-primary"
                                         style="width:88%;"></div>

                                </div>

                            </td>

                        </tr>

                        <!-- SALARY -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-cash-stack text-warning"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">

                                            Salary

                                        </h6>

                                        <small class="text-muted">

                                            Salary & payroll reports

                                        </small>

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

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-warning"
                                         style="width:90%;"></div>

                                </div>

                            </td>

                        </tr>

                        <!-- DAILY WORK -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-list-task text-info"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">

                                            Daily Work

                                        </h6>

                                        <small class="text-muted">

                                            Daily task reports

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                            <span class="fw-bold fs-5">

                                {{ $dailyWorks }}

                            </span>

                            </td>

                            <td>

                            <span class="badge bg-info px-3 py-2 rounded-pill">

                                Updated

                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-info"
                                         style="width:80%;"></div>

                                </div>

                            </td>

                        </tr>

                        <!-- PERFORMANCE -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-graph-up-arrow text-danger"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">

                                            Performance

                                        </h6>

                                        <small class="text-muted">

                                            Employee performance reports

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                            <span class="fw-bold fs-5">

                                {{ $performances }}

                            </span>

                            </td>

                            <td>

                            <span class="badge bg-danger px-3 py-2 rounded-pill">

                                Generated

                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-danger"
                                         style="width:85%;"></div>

                                </div>

                            </td>

                        </tr>

                        <!-- LEAVE -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-airplane-fill text-secondary"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">

                                            Leaves

                                        </h6>

                                        <small class="text-muted">

                                            Leave management reports

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                            <span class="fw-bold fs-5">

                                {{ $leaves }}

                            </span>

                            </td>

                            <td>

                            <span class="badge bg-secondary px-3 py-2 rounded-pill">

                                Active

                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-secondary"
                                         style="width:78%;"></div>

                                </div>

                            </td>

                        </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
<div>
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

    </script>
@endsection
