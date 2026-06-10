@extends('layouts.admin')

@section('page-title', 'Performance')

@section('content')

    <div class="container-fluid py-4">

        <div class="performance-header rounded-4 mb-4">

            <div>

        <span class="performance-badge">
            <i class="bi bi-bar-chart-line-fill me-1"></i>
            Performance Analytics
        </span>

                <h2 class="fw-bold mt-3 mb-1">
                    @role('employee')
                    My Performance
                    @else
                        Performance Module
                        @endrole
                </h2>

                <p class="mb-0 opacity-75">
                    Manage employee performance records & analytics
                </p>

            </div>

            <div class="d-flex gap-2 flex-wrap">

                @if(auth()->user()->hasAnyRole(['super-admin'])
                    || auth()->user()->can('performance.create.team'))
                    <a href="{{ route('performance.create') }}"
                       class="btn btn-primary rounded-pill px-3 shadow-sm">
                        <i class="bi bi-magic me-1"></i>
                        Generate Rating
                    </a>
                @endif

                @if(auth()->user()->hasAnyRole(['super-admin'])
                    || auth()->user()->can('performance.export.all'))
                    <a href="{{ route('performance.export') }}"
                       class="btn btn-success rounded-pill px-3 shadow-sm">
                        <i class="bi bi-download me-1"></i>
                        Export
                    </a>
                @endif

                @if(auth()->user()->hasAnyRole(['super-admin', 'manager'])
                    || auth()->user()->can('performance.report.view.all'))
                    <a href="{{ route('performance.monthly') }}"
                       class="btn btn-secondary rounded-pill px-3 shadow-sm">
                        <i class="bi bi-calendar-month me-1"></i>
                        Monthly Report
                    </a>
                @endif

            </div>

        </div>
        <div class="row g-4 mb-4">

            <div class="col-lg-3 col-md-6">
                <div class="performance-stat-card">
                    <div class="icon bg-primary-subtle text-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div>
                        <small>Total Records</small>
                        <h3>{{ $performances->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="performance-stat-card">
                    <div class="icon bg-success-subtle text-success">
                        <i class="bi bi-award-fill"></i>
                    </div>

                    <div>
                        <small>Excellent</small>
                        <h3>
                            {{ $performances->where('rating_grade','A')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="performance-stat-card">
                    <div class="icon bg-warning-subtle text-warning">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>

                    <div>
                        <small>Average</small>
                        <h3>
                            {{ $performances->where('rating_grade','B')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="performance-stat-card">
                    <div class="icon bg-danger-subtle text-danger">
                        <i class="bi bi-bar-chart"></i>
                    </div>

                    <div>
                        <small>Need Improvement</small>
                        <h3>
                            {{ $performances->where('rating_grade','C')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="card-header bg-dark text-white py-4 border-0">
                <h5 class="mb-0 fw-semibold">Performance Records</h5>
                <small class="text-light opacity-75">Role wise control panel</small>
            </div>

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

                        @forelse($performances as $p)

                            <tr class="border-bottom">

                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center shadow-sm employee-logo">
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

                                <td>
                                <span class="badge bg-dark-subtle text-dark rounded-pill px-3 py-2">
                                    {{ $p->month }}
                                </span>
                                </td>

                                <td>
                                <span class="fw-semibold text-primary">
                                    {{ $p->attendance_score }}
                                </span>
                                </td>

                                <td>
                                <span class="fw-semibold text-success">
                                    {{ $p->task_completion_score }}
                                </span>
                                </td>

                                <td>
                                <span class="fw-bold text-warning">
                                    {{ $p->manager_rating }}
                                </span>
                                </td>
                                <td>
                                <span class="fw-bold text-warning">
                                    {{ $p->self_rating}}
                                </span>
                                </td>
                                <td>
                                <span class="fw-bold text-dark">
                                    {{ $p->final_rating ?? 'No Rating' }}
                                </span>
                                </td>

                                <td>
                                <span class="badge px-3 py-2 rounded-pill
                                    @if($p->rating_grade == 'A') bg-success
                                    @elseif($p->rating_grade == 'B') bg-primary
                                    @else bg-warning text-dark
                                    @endif">
                                    {{ $p->rating_grade }}
                                </span>
                                </td>

                                <td class="text-center">
                                    @if(auth()->user()->hasAnyRole(['super-admin'])
                                     || auth()->user()->can('performance.view.self')
                                     || auth()->user()->can('performance.view.team')
                                     || auth()->user()->can('performance.view.all'))

                                    <a href="{{ route('performance.show',$p->id) }}"
                                       class="btn btn-info btn-sm rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-eye me-1"></i>
                                        View
                                    </a>
                                    @endif
                                    <a href="{{ route('performance.graph', $p->employee_id) }}"
                                       class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-graph-up me-1"></i>
                                        KPI Graph
                                    </a>

                                        @if(auth()->user()->hasAnyRole(['super-admin'])
                                        || auth()->user()->can('performance.edit.team'))
                                    <a href="{{ route('performance.edit',$p->id) }}"
                                       class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </a>
                                        @endif
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    No Performance Records Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
