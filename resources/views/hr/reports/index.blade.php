@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>

                        <h2 class="fw-bold mb-1 text-dark">
                            HR Reports Dashboard
                        </h2>

                        <p class="text-muted mb-0">
                            Employee analytics, attendance, salary and performance insights
                        </p>

                    </div>

                    <button onclick="printReport()"
                            class="btn btn-dark px-4 py-2 rounded-3 shadow-sm">

                        <i class="bi bi-printer-fill me-2"></i>

                        Print Report

                    </button>

                </div>

            </div>

        </div>

        <div id="printSection">
             <!-- ANALYTICS CARDS -->

             <div class="row g-4">

            <!-- EMPLOYEES -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Employees
                                </p>

                                <h1 class="fw-bold text-primary mb-0">
                                    {{ $employees }}
                                </h1>

                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:75px;height:75px;">

                                <i class="bi bi-people-fill text-primary fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PRESENT -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Present Employees
                                </p>

                                <h1 class="fw-bold text-success mb-0">
                                    {{ $presentEmployees }}
                                </h1>

                            </div>

                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:75px;height:75px;">

                                <i class="bi bi-check-circle-fill text-success fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- SALARY -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Salary Summary
                                </p>

                                <h1 class="fw-bold text-dark mb-0">
                                    ₹ {{ number_format($salary, 2) }}
                                </h1>

                            </div>

                            <div class="bg-dark bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:75px;height:75px;">

                                <i class="bi bi-cash-stack text-dark fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PERFORMANCE -->

            <div class="col-xl-6 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Performance Reports
                                </p>

                                <h1 class="fw-bold text-info mb-2">
                                    {{ number_format($averageRating, 1) }}
                                </h1>

                                <span class="badge bg-info px-3 py-2 rounded-pill">
                                Average Rating
                            </span>

                            </div>

                            <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:75px;height:75px;">

                                <i class="bi bi-bar-chart-fill text-info fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- LEAVES -->

            <div class="col-xl-6 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Leave Reports
                                </p>

                                <h1 class="fw-bold text-danger mb-2">
                                    {{ $leaves }}
                                </h1>

                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                Pending : {{ $pendingLeaves }}
                            </span>

                            </div>

                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:75px;height:75px;">

                                <i class="bi bi-calendar-x-fill text-danger fs-2"></i>

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
                            HR Analytics
                        </h4>

                        <p class="mb-0 text-light">
                            Complete HR department analytics summary
                        </p>

                    </div>

                    <div class="bg-white text-dark rounded-pill px-4 py-2 fw-semibold">

                        Live Reports

                    </div>

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

                        <!-- EMPLOYEES -->

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
                                            Active employee records
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

                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-calendar-check-fill text-primary"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">
                                            Attendance
                                        </h6>

                                        <small class="text-muted">
                                            Attendance tracking reports
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

                        <!-- PERFORMANCE -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-bar-chart-fill text-info"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">
                                            Performance
                                        </h6>

                                        <small class="text-muted">
                                            Employee performance ratings
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

                            <span class="badge bg-info px-3 py-2 rounded-pill">
                                Ratings
                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-info"
                                         style="width:82%;"></div>

                                </div>

                            </td>

                        </tr>

                        <!-- LEAVES -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-calendar-x-fill text-danger"></i>

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

                            <span class="badge bg-danger px-3 py-2 rounded-pill">
                                Pending {{ $pendingLeaves }}
                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-danger"
                                         style="width:60%;"></div>

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
