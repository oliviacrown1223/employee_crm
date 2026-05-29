@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">Performance Details</h2>
                <p class="text-muted mb-0">Complete evaluation summary of employee performance</p>
            </div>

        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white py-4 border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 fw-semibold">Employee Performance Report</h5>
                        <small class="text-light opacity-75">Detailed KPI breakdown</small>
                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="card-body p-4">

                <!-- EMPLOYEE NAME -->
                <div class="text-center mb-4">

                    <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center mx-auto shadow"
                         style="width:70px;height:70px;font-size:24px;">

                        {{ strtoupper(substr($performance->employee->name,0,1)) }}

                    </div>

                    <h4 class="fw-bold mt-3 mb-1">
                        {{ $performance->employee->name }}
                    </h4>

                    <span class="badge bg-dark-subtle text-dark px-3 py-2 rounded-pill">
                    Employee Performance
                </span>

                </div>

                <hr>

                <!-- DETAILS GRID -->
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Month</small>
                            <div class="fw-semibold">{{ $performance->month }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Attendance Score</small>
                            <div class="fw-semibold text-primary">{{ $performance->attendance_score }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Task Completion</small>
                            <div class="fw-semibold text-success">{{ $performance->task_completion_score }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Manager Rating</small>
                            <div>
                                @for($i=1; $i <= $performance->manager_rating; $i++)
                                    <i class="bi bi-star-fill text-warning fs-5"></i>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Employee Self Rating</small>
                            <div>
                                @for($i=1; $i <= $performance->self_rating; $i++)
                                    <i class="bi bi-star-fill text-primary fs-5"></i>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted">Final Rating</small>
                            <div class="fw-semibold text-dark">
                                {{ $performance->final_rating }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="p-3 border rounded-3 text-center">

                            <small class="text-muted d-block mb-2">Grade</small>

                            <span class="badge px-4 py-2 rounded-pill fs-6
                            @if($performance->rating_grade == 'A') bg-success
                            @elseif($performance->rating_grade == 'B') bg-primary
                            @else bg-warning text-dark
                            @endif">

                            {{ $performance->rating_grade }}

                        </span>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
