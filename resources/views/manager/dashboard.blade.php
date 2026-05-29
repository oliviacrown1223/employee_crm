@extends('manager.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">

            <div>

                <h2 class="fw-bold mb-1 text-dark">
                    Manager Dashboard
                </h2>

                <p class="text-muted mb-0">
                    Welcome back! Monitor your team performance & daily activities.
                </p>

            </div>



        </div>



        <!-- STATISTICS -->
        <div class="row g-4 mb-4">

            <!-- TEAM EMPLOYEES -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 rounded-4 shadow-lg h-100 overflow-hidden">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-people-fill display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Team Employees
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalEmployees }}
                                </h2>

                            </div>

                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-people-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- ATTENDANCE -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 rounded-4 shadow-lg h-100 overflow-hidden">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-calendar-check-fill display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Attendance
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalAttendance }}
                                </h2>

                            </div>

                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-calendar-check-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- TASKS -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 rounded-4 shadow-lg h-100 overflow-hidden">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-list-task display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Tasks
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalTasks }}
                                </h2>

                            </div>

                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-list-task fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- PERFORMANCE -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 rounded-4 shadow-lg h-100 overflow-hidden">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-bar-chart-line-fill display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Performance
                                </p>

                                <h2 class="fw-bold mb-0">
                                    {{ $totalPerformance }}
                                </h2>

                            </div>

                            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-bar-chart-line-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- CONTENT -->
        <div class="row g-4">

            <!-- RECENT ACTIVITY -->
            <div class="col-lg-8">

                <div class="card border-0 rounded-4 shadow-lg h-100">

                    <div class="card-header bg-white border-0 p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h4 class="fw-bold mb-1">
                                    Recent Activity
                                </h4>

                                <p class="text-muted mb-0">
                                    Latest updates from your department
                                </p>

                            </div>

                            <button class="btn btn-light rounded-3 border">

                                View All

                            </button>

                        </div>

                    </div>

                    <div class="card-body pt-0">

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead class="table-light">

                                <tr>

                                    <th class="py-3">Module</th>

                                    <th class="py-3">Status</th>

                                    <th class="py-3">Date</th>

                                </tr>

                                </thead>

                                <tbody>

                                <tr>

                                    <td class="fw-semibold">
                                        Attendance Updated
                                    </td>

                                    <td>

                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                            Completed

                                        </span>

                                    </td>

                                    <td class="text-muted">

                                        {{ now()->format('d M Y') }}

                                    </td>

                                </tr>

                                <tr>

                                    <td class="fw-semibold">
                                        Task Assigned
                                    </td>

                                    <td>

                                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">

                                            Pending

                                        </span>

                                    </td>

                                    <td class="text-muted">

                                        {{ now()->format('d M Y') }}

                                    </td>

                                </tr>

                                <tr>

                                    <td class="fw-semibold">
                                        Performance Review
                                    </td>

                                    <td>

                                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">

                                            In Progress

                                        </span>

                                    </td>

                                    <td class="text-muted">

                                        {{ now()->format('d M Y') }}

                                    </td>

                                </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>



            <!-- QUICK REPORT -->
            <div class="col-lg-4">

                <div class="card border-0 rounded-4 shadow-lg h-100">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">

                            Quick Report

                        </h4>

                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <span class="fw-semibold">
                                    Team Productivity
                                </span>

                                <span class="text-success fw-bold">
                                    85%
                                </span>

                            </div>

                            <div class="progress rounded-pill" style="height:10px;">

                                <div class="progress-bar"
                                     style="width:85%;"></div>

                            </div>

                        </div>

                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <span class="fw-semibold">
                                    Attendance Rate
                                </span>

                                <span class="text-primary fw-bold">
                                    92%
                                </span>

                            </div>

                            <div class="progress rounded-pill" style="height:10px;">

                                <div class="progress-bar bg-success"
                                     style="width:92%;"></div>

                            </div>

                        </div>

                        <div>

                            <div class="d-flex justify-content-between mb-2">

                                <span class="fw-semibold">
                                    Task Completion
                                </span>

                                <span class="text-warning fw-bold">
                                    74%
                                </span>

                            </div>

                            <div class="progress rounded-pill" style="height:10px;">

                                <div class="progress-bar bg-warning"
                                     style="width:74%;"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-lg-12 mt-4">

                <div class="card border-0 rounded-4 shadow-lg overflow-hidden">

                    <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <div>

                            <h4 class="fw-bold mb-1">
                                Live Attendance Analytics
                            </h4>

                            <p class="text-muted mb-0">
                                Weekly attendance overview of employees
                            </p>

                        </div>

                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                Live Data
            </span>

                    </div>

                    <div class="card-body p-4">

                        <canvas id="attendanceChart" height="100"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@push('scripts')

    <script>

        const ctx = document.getElementById('attendanceChart');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: [
                    'Mon',
                    'Tue',
                    'Wed',
                    'Thu',
                    'Fri',
                    'Sat',
                    'Sun'
                ],

                datasets: [{

                    label: 'Present Employees',

                    data: [35, 40, 38, 45, 42, 30, 25],

                    borderWidth: 4,

                    tension: 0.4,

                    fill: true,

                    backgroundColor: 'rgba(13,110,253,0.1)',

                    borderColor: '#0d6efd',

                    pointBackgroundColor: '#0d6efd',

                    pointRadius: 5,

                    pointHoverRadius: 7

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        display: true,
                        position: 'top'
                    }

                },

                scales: {

                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }

                }

            }

        });

    </script>

@endpush
