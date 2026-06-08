@extends('layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="mb-4">
            <h3 class="fw-bold">
                Search Results
            </h3>

            <p class="text-muted">
                Result for:
                <span class="fw-semibold">
                "{{ $q }}"
            </span>
            </p>
        </div>


        {{-- Employees --}}
        @if($employees->count())
            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-primary text-white">
                    Employees
                </div>

                <div class="card-body">

                    @foreach($employees as $employee)

                        <a href="{{ route('employees.index') }}"
                           class="text-decoration-none">

                            <div class="border rounded-3 p-3 mb-2">

                                <h6 class="fw-bold mb-1">
                                    {{ $employee->name }}
                                </h6>

                                <small class="text-muted">
                                    {{ $employee->email }}
                                </small>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>
        @endif



        {{-- Users --}}
        @if($users->count())
            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-success text-white">
                    Users
                </div>

                <div class="card-body">

                    @foreach($users as $user)

                        <a href="{{ route('users.index') }}"
                           class="text-decoration-none">

                            <div class="border rounded-3 p-3 mb-2">

                                <h6 class="fw-bold mb-1">
                                    {{ $user->name }}
                                </h6>

                                <small class="text-muted">
                                    {{ $user->email }}
                                </small>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>
        @endif



        {{-- Attendance --}}
        @if($attendances->count())
            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-info text-white">
                    Attendance
                </div>

                <div class="card-body">

                    @foreach($attendances as $attendance)

                        <a href="{{ route('attendance.index') }}"
                           class="text-decoration-none">

                            <div class="border rounded-3 p-3 mb-2">

                                <h6 class="fw-bold mb-1">
                                    {{ $attendance->employee->name ?? '-' }}
                                </h6>

                                <small class="text-muted">
                                    {{ ucfirst($attendance->status) }}
                                </small>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>
        @endif



        {{-- Salary --}}
        @if($salaries->count())
            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-warning">
                    Salary
                </div>

                <div class="card-body">

                    @foreach($salaries as $salary)

                        <a href="{{ route('salary.index') }}"
                           class="text-decoration-none">

                            <div class="border rounded-3 p-3 mb-2">

                                <h6 class="fw-bold mb-1">
                                    {{ $salary->employee->name ?? '-' }}
                                </h6>

                                <small class="text-muted">
                                    {{ $salary->salary_month }}
                                </small>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>
        @endif



        {{-- Daily Work --}}
        @if($works->count())
            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-secondary text-white">
                    Daily Work
                </div>

                <div class="card-body">

                    @foreach($works as $work)

                        <a href="{{ route('daily-work.index') }}"
                           class="text-decoration-none">

                            <div class="border rounded-3 p-3 mb-2">

                                <h6 class="fw-bold mb-1">
                                    {{ $work->task_title }}
                                </h6>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>
        @endif



        {{-- Performance --}}
        @if($performances->count())
            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-dark text-white">
                    Performance
                </div>

                <div class="card-body">

                    @foreach($performances as $performance)

                        <a href="{{ route('performance.index') }}"
                           class="text-decoration-none">

                            <div class="border rounded-3 p-3 mb-2">

                                <h6 class="fw-bold mb-1">
                                    {{ $performance->employee->name ?? '-' }}
                                </h6>

                                <small class="text-muted">
                                    {{ $performance->rating_grade }}
                                </small>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>
        @endif



        {{-- Leaves --}}
        @if($leaves->count())
            <div class="card shadow-sm border-0 rounded-4 mb-4">

                <div class="card-header bg-danger text-white">
                    Leaves
                </div>

                <div class="card-body">

                    @foreach($leaves as $leave)

                        <a href="{{ route('leave.index') }}"
                           class="text-decoration-none">

                            <div class="border rounded-3 p-3 mb-2">

                                <h6 class="fw-bold mb-1">
                                    {{ $leave->employee->name ?? '-' }}
                                </h6>

                                <small class="text-muted">
                                    {{ $leave->leave_type }}
                                </small>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>
        @endif



        @if(
            !$employees->count() &&
            !$users->count() &&
            !$attendances->count() &&
            !$salaries->count() &&
            !$works->count() &&
            !$performances->count() &&
            !$leaves->count()
        )

            <div class="alert alert-warning rounded-4">
                No results found.
            </div>

        @endif

    </div>

@endsection
