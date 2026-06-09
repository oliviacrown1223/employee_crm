@extends('layouts.admin')

@section('page-title', 'Performance Details')

@section('content')

    <div class="container-fluid py-4 performance-view-page">

        <div class="performance-view-hero mb-4">

            <div>
            <span class="performance-view-badge">
                <i class="bi bi-bar-chart-line-fill me-1"></i>
                Performance Details
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Employee Performance Details
                </h2>

                <p class="mb-0 opacity-75">
                    Monthly performance overview and rating summary
                </p>
            </div>

            <span class="performance-month-pill">
            {{ $performance->month }}
        </span>

        </div>

        <div class="performance-profile-card mb-4">

            <div class="d-flex align-items-center gap-4 flex-wrap">

                <div class="performance-profile-avatar">
                    {{ strtoupper(substr($performance->employee->name,0,1)) }}
                </div>

                <div>
                    <h3 class="fw-bold mb-1">
                        {{ $performance->employee->name }}
                    </h3>

                    <p class="text-muted mb-0">
                        Employee Performance Report
                    </p>
                </div>

            </div>

            <div class="text-md-end">

                <small class="text-muted fw-semibold">
                    Final Grade
                </small>

                <div class="mt-2">
                <span class="performance-grade-pill">
                    {{ $performance->rating_grade }}
                </span>
                </div>

            </div>

        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="performance-score-card score-blue">
                    <i class="bi bi-calendar-check"></i>
                    <span>Attendance Score</span>
                    <h2>{{ $performance->attendance_score }}</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="performance-score-card score-green">
                    <i class="bi bi-check2-square"></i>
                    <span>Task Completion</span>
                    <h2>{{ $performance->task_completion_score }}</h2>
                </div>
            </div>

            <div class="col-md-4">
                <div class="performance-score-card score-orange">
                    <i class="bi bi-star-fill"></i>
                    <span>Manager Rating</span>
                    <h2>{{ $performance->manager_rating }}</h2>
                </div>
            </div>

        </div>

        <div class="performance-overall-card mt-4">

            <div>
            <span class="overall-label">
                Overall Performance Rating
            </span>

                <h1>
                    {{ $performance->final_rating }}
                </h1>
            </div>

            <div>
            <span class="overall-grade">
                Grade : {{ $performance->rating_grade }}
            </span>
            </div>

        </div>

        @role('employee')

        <div class="self-rating-card mt-4">

            <div class="self-rating-header">
                <div>
                    <h5 class="fw-bold mb-1">
                        Give Rating To Yourself
                    </h5>

                    <small class="text-muted">
                        Submit your self rating from 1 to 5
                    </small>
                </div>
            </div>

            <div class="self-rating-body">

                <form method="POST"
                      action="{{ route('performance.self.rating',$performance->id) }}">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Your Rating (1 - 5)
                        </label>

                        <input type="number"
                               min="1"
                               max="5"
                               name="self_rating"
                               class="form-control self-rating-input">
                    </div>

                    <button type="submit"
                            class="btn btn-success rounded-pill px-4 fw-semibold">
                        Submit Rating
                    </button>

                </form>

            </div>

        </div>

        @endrole

    </div>

@endsection
