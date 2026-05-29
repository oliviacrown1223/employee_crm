@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">All Employee Performance</h2>
                <p class="text-muted mb-0">HR overview of all employee KPIs, ratings & grades</p>
            </div>

            <a href="{{ route('hr.performance.export') }}"
               class="btn btn-success rounded-pill px-3 shadow-sm">

                <i class="bi bi-download me-1"></i>
                Export

            </a>

        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white py-4 border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 fw-semibold">Performance Overview</h5>
                        <small class="text-light opacity-75">All employees evaluation records</small>
                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">
                        <tr class="text-uppercase small fw-bold text-muted">

                            <th class="px-4 py-3">Employee</th>
                            <th>Month</th>
                            <th>Attendance</th>
                            <th>Task</th>
                            <th>Manager Rating</th>
                            <th>Employee Rating</th>
                            <th>Final Rating</th>
                            <th>Grade</th>
                            <th class="text-center">Action</th>

                        </tr>
                        </thead>

                        <tbody>

                        @foreach($performances as $p)

                            <tr class="border-bottom">

                                <!-- EMPLOYEE -->
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center shadow-sm"
                                             style="width:45px;height:45px;">
                                            {{ strtoupper(substr($p->employee->name,0,1)) }}
                                        </div>

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $p->employee->name }}
                                            </div>
                                            <small class="text-muted">Employee</small>
                                        </div>

                                    </div>
                                </td>

                                <!-- MONTH -->
                                <td>
                                    <span class="badge bg-dark-subtle text-dark rounded-pill px-3 py-2">
                                        {{ $p->month }}
                                    </span>
                                </td>

                                <!-- ATTENDANCE -->
                                <td>
                                    <span class="fw-semibold text-primary">
                                        {{ $p->attendance_score }}
                                    </span>
                                </td>

                                <!-- TASK -->
                                <td>
                                    <span class="fw-semibold text-success">
                                        {{ $p->task_completion_score }}
                                    </span>
                                </td>

                                <!-- MANAGER RATING -->
                                <td>
                                    @for($i=1; $i <= $p->manager_rating; $i++)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @endfor
                                </td>

                                <!-- EMPLOYEE RATING -->
                                <td>
                                    @if($p->self_rating)

                                        @for($i=1; $i <= $p->self_rating; $i++)
                                            <i class="bi bi-star-fill text-primary"></i>
                                        @endfor

                                    @else
                                        <span class="text-muted small">N/A</span>
                                    @endif
                                </td>

                                <!-- FINAL RATING -->
                                <td>
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        {{ $p->final_rating }}
                                    </span>
                                </td>

                                <!-- GRADE -->
                                <td>
                                    <span class="badge bg-dark px-3 py-2 rounded-pill">
                                        {{ $p->rating_grade }}
                                    </span>
                                </td>

                                <!-- ACTION -->
                                <td class="text-center">

                                    @if(auth()->user()->can('performance.view.all'))

                                        <a href="{{ route('hr.performance.showw', $p->id) }}"
                                           class="btn btn-info btn-sm rounded-pill px-3 shadow-sm">

                                            <i class="bi bi-eye me-1"></i>
                                            View

                                        </a>

                                    @else

                                        <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                            View
                                        </button>

                                    @endif

                                    <a href="{{ route('hr.performance.graph', $p->employee_id) }}"
                                       class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">

                                        <i class="bi bi-graph-up me-1"></i>
                                        KPI Graph

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
