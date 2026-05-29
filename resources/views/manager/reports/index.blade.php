@extends('manager.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>

                        <h2 class="fw-bold mb-1 text-dark">
                            Team Reports Dashboard
                        </h2>

                        <p class="text-muted mb-0">
                            Advanced analytics and team performance overview
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

                    <!-- TOP ANALYTICS -->

                   <div class="row g-4">

            <!-- ATTENDANCE -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Team Attendance
                                </p>

                                <h1 class="fw-bold text-primary mb-2">
                                    {{ $attendance }}
                                </h1>

                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                Present : {{ $presentEmployees }}
                            </span>

                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:75px;height:75px;">

                                <i class="bi bi-calendar-check-fill text-primary fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- DAILY WORK -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Daily Work Reports
                                </p>

                                <h1 class="fw-bold text-warning mb-2">
                                    {{ $dailyWorks }}
                                </h1>

                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                Pending : {{ $pendingWorks }}
                            </span>

                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:75px;height:75px;">

                                <i class="bi bi-clipboard-data-fill text-warning fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PERFORMANCE -->

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 h-100 overflow-hidden">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Team Performance
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

        </div>

                    <!-- ANALYTICS TABLE -->

                   <div class="card border-0 shadow-lg rounded-4 overflow-hidden mt-5">

            <div class="card-header bg-dark text-white border-0 p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4 class="fw-bold mb-1">
                            Team Analytics
                        </h4>

                        <p class="mb-0 text-light">
                            Detailed module performance summary
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
                                            Team attendance tracking
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

                            <span class="badge bg-success px-3 py-2 rounded-pill">
                                Updated
                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-success"
                                         style="width:90%;"></div>

                                </div>

                            </td>

                        </tr>

                        <!-- DAILY WORK -->

                        <tr>

                            <td class="ps-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width:45px;height:45px;">

                                        <i class="bi bi-clipboard-data-fill text-warning"></i>

                                    </div>

                                    <div>

                                        <h6 class="mb-0 fw-bold">
                                            Daily Work
                                        </h6>

                                        <small class="text-muted">
                                            Daily work management
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

                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                Pending {{ $pendingWorks }}
                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-warning"
                                         style="width:70%;"></div>

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
                                            Team performance reports
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
                                Ratings Generated
                            </span>

                            </td>

                            <td class="text-end pe-4">

                                <div class="progress" style="height:8px;">

                                    <div class="progress-bar bg-info"
                                         style="width:85%;"></div>

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
