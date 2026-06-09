@extends('layouts.admin')

@section('page-title', 'Attendance')

@section('content')

    <div class="container-fluid py-4 attendance-page">

        <div class="attendance-hero mb-4">

            <div>
            <span class="attendance-badge">
                <i class="bi bi-calendar-check-fill me-1"></i>
                Attendance Module
            </span>

                <h3 class="fw-bold mt-3 mb-2">

                    @if(auth()->user()->hasRole('employee'))
                        My Attendance

                    @elseif(auth()->user()->hasRole('manager'))
                        Team Attendance

                    @else
                        Attendance Management
                    @endif

                </h3>

                <p class="mb-0 opacity-75">
                    Role wise attendance tracking
                </p>
            </div>

            @hasanyrole('super-admin|hr')
            {{-- If needed, uncomment button --}}
            {{--
            <button type="button"
                    class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#attendanceModal">
                <i class="bi bi-plus-circle me-1"></i>
                Mark Attendance
            </button>
            --}}
            @endhasanyrole

        </div>

        @hasanyrole('super-admin|hr')
        <div class="modal fade" id="attendanceModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content attendance-modal">

                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">
                            Mark Attendance
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form id="attendanceForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Employee</label>

                                <select name="employee_id"
                                        class="form-select attendance-input"
                                        required>
                                    <option value="">Select Employee</option>

                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>

                                <select name="status"
                                        class="form-select attendance-input">
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                </select>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                                Save Attendance
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endhasanyrole

        <div class="row g-4 mb-4">

            <div class="col-xl-3 col-md-6">
                <div class="attendance-stat-card stat-blue">
                    <div>
                        <small>Total Employees</small>
                        <h2>{{ $totalEmployees }}</h2>
                    </div>

                    <div class="attendance-stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="attendance-stat-card stat-green">
                    <div>
                        <small>Present Today</small>
                        <h2>{{ $presentToday }}</h2>
                    </div>

                    <div class="attendance-stat-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>

            @hasanyrole('super-admin|hr|manager')
            <div class="col-xl-3 col-md-6">
                <div class="attendance-stat-card stat-red">
                    <div>
                        <small>Absent Today</small>
                        <h2>{{ $absentToday }}</h2>
                    </div>

                    <div class="attendance-stat-icon">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                </div>
            </div>
            @endhasanyrole

            <div class="col-xl-3 col-md-6">
                <div class="attendance-stat-card stat-orange">
                    <div>
                        <small>Late Today</small>
                        <h2>{{ $lateToday }}</h2>
                    </div>

                    <div class="attendance-stat-icon">
                        <i class="bi bi-alarm-fill"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="attendance-card">

            <div class="attendance-card-header">

                <div>
                    <h5 class="fw-bold mb-1">
                        Attendance Records
                    </h5>

                    <small class="text-muted">
                        Manage employee attendance activity
                    </small>
                </div>

                <span class="attendance-count-pill">
                {{ $employees->count() }} Records
            </span>

            </div>

            <div class="table-responsive">

                <table class="table attendance-table align-middle mb-0">

                    <thead>
                    <tr>
                        <th class="ps-4">Employee</th>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Hours</th>
                        <th>Late</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($employees as $employee)

                        @php
                            $attendance = $employee->attendance->first();
                        @endphp

                        <tr>
                            <td class="ps-4">
                                <div class="attendance-user">
                                    <div class="attendance-avatar">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <h6 class="mb-0 fw-bold">
                                            {{ $employee->name }}
                                        </h6>
                                        <small class="text-muted">{{ $employee->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                            <span class="date-pill">
                                {{ $attendance->attendance_date ?? '-' }}
                            </span>
                            </td>

                            <td>
                            <span class="time-pill checkin">
                                {{ $attendance->check_in ?? '-' }}
                            </span>
                            </td>

                            <td>
                            <span class="time-pill checkout">
                                {{ $attendance->check_out ?? '-' }}
                            </span>
                            </td>

                            <td>
                            <span class="hours-pill">
                                {{ $attendance->working_hours ?? 0 }} hrs
                            </span>
                            </td>

                            <td>
                                @if($attendance && $attendance->is_late)
                                    <span class="attendance-badge-pill late-pill">
                                    Late
                                </span>
                                @else
                                    <span class="attendance-badge-pill ontime-pill">
                                    On Time
                                </span>
                                @endif
                            </td>

                            <td>
                                @if($attendance && $attendance->status == 'present')
                                    <span class="attendance-status present-pill">Present</span>
                                @elseif($attendance && $attendance->status == 'absent')
                                    <span class="attendance-status absent-pill">Absent</span>
                                @else
                                    <span class="attendance-status notmarked-pill">Not Marked</span>
                                @endif
                            </td>

                            <td class="text-center">

                                <div class="d-flex align-items-center justify-content-center flex-wrap gap-2">

                                    @if(auth()->user()->hasAnyRole(['super-admin', 'hr'])
                                        || auth()->user()->can('attendance.mark.team')
                                        || auth()->user()->can('attendance.mark.self'))

                                        @if(!$attendance || !$attendance->check_in)
                                            <button class="attendance-action-btn checkin-btn checkInBtn"
                                                    data-id="{{ $employee->id }}">
                                                Check-In
                                            </button>
                                        @else
                                            <button class="attendance-action-btn disabled-btn" disabled>
                                                Checked-In
                                            </button>
                                        @endif

                                        @if($attendance && $attendance->check_in && !$attendance->check_out)
                                            <button class="attendance-action-btn checkout-btn checkOutBtn"
                                                    data-id="{{ $attendance->id }}">
                                                Check-Out
                                            </button>
                                        @elseif($attendance && $attendance->check_out)
                                            <button class="attendance-action-btn completed-btn" disabled>
                                                Completed
                                            </button>
                                        @endif

                                    @endif

                                    @if(auth()->user()->hasAnyRole(['super-admin'])
                                       || auth()->user()->can('attendance.edit.all'))
                                        @if($attendance && $attendance->check_in)
                                            <a href="{{ route('attendance.edit', $attendance->id) }}"
                                               class="attendance-action-btn edit-attendance-btn">
                                                Edit
                                            </a>
                                        @endif
                                    @endif

                                    @if(auth()->user()->hasAnyRole(['super-admin'])
                                        || auth()->user()->can('attendance.approve.team')
                                        || auth()->user()->can('attendance.approve.all'))

                                        @if($attendance && !$attendance->is_approved)
                                            <button class="attendance-action-btn approve-btn approveBtn"
                                                    data-id="{{ $attendance->id }}">
                                                Approve
                                            </button>
                                        @elseif($attendance && $attendance->is_approved)
                                            <span class="approved-pill">
                                            Approved
                                        </span>
                                        @endif

                                    @endif

                                </div>

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-calendar-x fs-1 text-muted d-block mb-2"></i>
                                <h5>No Employees Found</h5>
                            </td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

@endsection
