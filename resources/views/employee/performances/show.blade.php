@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold text-dark mb-1">
                    Performance Details
                </h2>

                <p class="text-muted mb-0">
                    Monthly employee performance overview
                </p>

            </div>

            <span class="badge bg-primary px-4 py-3 rounded-pill fs-6 shadow-sm">
            {{ $performance->month }}
        </span>

        </div>

        <!-- MAIN CARD -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- TOP SECTION -->

            <div class="bg-dark text-white p-5">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <div class="d-flex align-items-center">

                            <div class="rounded-circle bg-white text-dark d-flex align-items-center justify-content-center fw-bold shadow"
                                 style="width:90px;height:90px;font-size:35px;">

                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                            </div>

                            <div class="ms-4">

                                <h2 class="fw-bold mb-1">
                                    {{ $performance->employee->name }}
                                </h2>
                                <p class="mb-0 text-light">
                                    Employee Performance Report
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4 text-md-end mt-4 mt-md-0">

                        <h6 class="text-light mb-2">
                            Final Rating
                        </h6>

                        <h1 class="fw-bold display-4 mb-0">
                            {{ $performance->final_rating }}
                        </h1>

                    </div>

                </div>

            </div>

            <!-- SCORE SECTION -->

            <div class="card-body p-5">

                <div class="row g-4 mb-5">

                    <!-- ATTENDANCE -->

                    <div class="col-md-4">

                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            <div class="card-body text-center p-4">

                                <div class="mb-3">

                                    <i class="bi bi-calendar-check-fill text-primary"
                                       style="font-size:45px;"></i>

                                </div>

                                <h5 class="fw-bold">
                                    Attendance Score
                                </h5>

                                <h2 class="text-primary fw-bold mt-3">
                                    {{ $performance->attendance_score }}
                                </h2>

                            </div>

                        </div>

                    </div>

                    <!-- TASK -->

                    <div class="col-md-4">

                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            <div class="card-body text-center p-4">

                                <div class="mb-3">

                                    <i class="bi bi-check-circle-fill text-success"
                                       style="font-size:45px;"></i>

                                </div>

                                <h5 class="fw-bold">
                                    Task Completion
                                </h5>

                                <h2 class="text-success fw-bold mt-3">
                                    {{ $performance->task_completion_score }}
                                </h2>

                            </div>

                        </div>

                    </div>

                    <!-- MANAGER -->

                    <div class="col-md-4">

                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            <div class="card-body text-center p-4">

                                <div class="mb-3">

                                    <i class="bi bi-star-fill text-warning"
                                       style="font-size:45px;"></i>

                                </div>

                                <h5 class="fw-bold">
                                    Manager Rating
                                </h5>

                                <h2 class="text-warning fw-bold mt-3">
                                    {{ $performance->manager_rating }}
                                </h2>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- FINAL GRADE -->

                <div class="text-center mb-5">

                    <h5 class="text-muted mb-3">
                        Performance Grade
                    </h5>

                    <span class="badge bg-success px-5 py-3 rounded-pill fs-3 shadow">
                    {{ $performance->rating_grade }}
                </span>

                </div>

                <!-- SELF RATING -->

                <div class="card border-0 bg-light rounded-4 shadow-sm">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-3">
                            Submit Self Rating
                        </h4>

                        <p class="text-muted mb-4">
                            Give your own performance rating for this month
                        </p>

                        <form method="POST"
                              action="{{ route('employee.performance.self', $performance->id) }}">

                            @csrf

                            <div class="row align-items-end">

                                <div class="col-md-9">

                                    <label class="form-label fw-semibold">
                                        Self Rating
                                    </label>



                                    <select name="self_rating"
                                            class="form-control">

                                        <option value="1">⭐ 1 Star</option>
                                        <option value="2">⭐⭐ 2 Star</option>
                                        <option value="3">⭐⭐⭐ 3 Star</option>
                                        <option value="4">⭐⭐⭐⭐ 4 Star</option>
                                        <option value="5">⭐⭐⭐⭐⭐ 5 Star</option>

                                    </select>

                                </div>

                                <div class="col-md-3 mt-3 mt-md-0">

                                    @if(auth()->user()->can('performance.rate.self'))

                                        <button class="btn btn-primary btn-lg w-100 rounded-3 shadow">

                                            <i class="bi bi-send-fill"></i>

                                            Submit

                                        </button>

                                    @else

                                        <button class="btn btn-secondary btn-lg w-100 rounded-3"
                                                disabled>

                                            Permission Denied

                                        </button>

                                    @endif

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
