@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>
                        <h2 class="fw-bold mb-1 text-dark">
                            Employee Performance Details
                        </h2>

                        <p class="text-muted mb-0">
                            Monthly performance overview and rating summary
                        </p>
                    </div>

                    <div class="text-end mt-3 mt-md-0">
                    <span class="badge bg-primary px-4 py-2 fs-6 rounded-pill">
                        {{ $performance->month }}
                    </span>
                    </div>

                </div>

            </div>
        </div>

        <!-- EMPLOYEE PROFILE -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px;height:80px;font-size:30px;font-weight:bold;">

                                {{ strtoupper(substr($performance->employee->name,0,1)) }}

                            </div>

                            <div class="ms-4">

                                <h3 class="fw-bold mb-1">
                                    {{ $performance->employee->name }}
                                </h3>

                                <p class="text-muted mb-0">
                                    Employee Performance Report
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 text-md-end mt-4 mt-md-0">

                        <h6 class="text-muted mb-2">
                            Final Grade
                        </h6>

                        <span class="badge bg-success px-4 py-3 fs-5 rounded-pill">
                        {{ $performance->rating_grade }}
                    </span>

                    </div>

                </div>

            </div>
        </div>

        <!-- PERFORMANCE SCORES -->
        <div class="row g-4">

            <!-- Attendance -->
            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 text-center">

                        <div class="mb-3">
                            <i class="bi bi-calendar-check text-primary"
                               style="font-size:45px;"></i>
                        </div>

                        <h5 class="fw-bold">
                            Attendance Score
                        </h5>

                        <h2 class="fw-bold text-primary mt-3">
                            {{ $performance->attendance_score }}
                        </h2>

                    </div>
                </div>

            </div>

            <!-- Task Completion -->
            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 text-center">

                        <div class="mb-3">
                            <i class="bi bi-check2-square text-success"
                               style="font-size:45px;"></i>
                        </div>

                        <h5 class="fw-bold">
                            Task Completion
                        </h5>

                        <h2 class="fw-bold text-success mt-3">
                            {{ $performance->task_completion_score }}
                        </h2>

                    </div>
                </div>

            </div>

            <!-- Manager Rating -->
            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 text-center">

                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"
                               style="font-size:45px;"></i>
                        </div>

                        <h5 class="fw-bold">
                            Manager Rating
                        </h5>

                        <h2 class="fw-bold text-warning mt-3">
                            {{ $performance->manager_rating }}
                        </h2>

                    </div>
                </div>

            </div>

        </div>

        <!-- FINAL RESULT -->
        <div class="card border-0 shadow-lg rounded-4 mt-5">
            <div class="card-body p-5 text-center">

                <h5 class="text-muted mb-3">
                    Overall Performance Rating
                </h5>

                <h1 class="fw-bold text-dark display-3 mb-3">
                    {{ $performance->final_rating }}
                </h1>

                <span class="badge bg-dark px-5 py-3 fs-4 rounded-pill">
                Grade : {{ $performance->rating_grade }}
            </span>

            </div>
        </div>

    </div>

@endsection
