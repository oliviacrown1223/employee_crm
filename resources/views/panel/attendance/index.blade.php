@extends('layouts.admin')

@section('page-title', 'Attendance')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-1">
                    @role('employee')
                    My Attendance
                    @elseifrole('manager')
                    Team Attendance
                    @else
                        Attendance Management
                        @endrole
                </h3>

                <p class="text-muted mb-0">
                    Role wise attendance tracking
                </p>
            </div>

         {{--   @hasanyrole('super-admin|hr')
            <button type="button"
                    class="btn btn-primary rounded-3"
                    data-bs-toggle="modal"
                    data-bs-target="#attendanceModal">
                <i class="bi bi-plus-circle"></i>
                Mark Attendance
            </button>
            @endhasanyrole--}}

        </div>

        @hasanyrole('super-admin|hr')
        <div class="modal fade" id="attendanceModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content rounded-4">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Mark Attendance</h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form id="attendanceForm">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Employee</label>

                                <select name="employee_id"
                                        class="form-select"
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
                                <label class="form-label">Status</label>

                                <select name="status"
                                        class="form-select">
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                </select>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary w-100 rounded-3">
                                Save Attendance
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endhasanyrole

        <div class="row g-4 mb-5">

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-2 fw-semibold">Total Employees</p>
                                <h2 class="fw-bold mb-0">{{ $totalEmployees }}</h2>
                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box">
                                <i class="bi bi-people-fill text-primary fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-2 fw-semibold">Present Today</p>
                                <h2 class="fw-bold mb-0 text-success">{{ $presentToday }}</h2>
                            </div>

                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box">
                                <i class="bi bi-check-circle-fill text-success fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @hasanyrole('super-admin|hr|manager')
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-2 fw-semibold">Absent Today</p>
                                <h2 class="fw-bold mb-0 text-danger">{{ $absentToday }}</h2>
                            </div>

                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box">
                                <i class="bi bi-x-circle-fill text-danger fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endhasanyrole

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-2 fw-semibold">Late Today</p>
                                <h2 class="fw-bold mb-0 text-warning">{{ $lateToday }}</h2>
                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center rounded-circle-Box"
                                 style="">
                                <i class="bi bi-alarm-fill text-warning fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-header bg-white border-0 py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-bold">Attendance Records</h5>
                        <small class="text-muted">Manage employee attendance activity</small>
                    </div>

                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                    {{ $employees->count() }} Records
                </span>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">
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
                                <h6 class="mb-0 fw-semibold">
                                    {{ $employee->name }}
                                </h6>
                                <small class="text-muted">{{ $employee->email }}</small>
                            </td>

                            <td>{{ $attendance->attendance_date ?? '-' }}</td>

                            <td>
                            <span class="text-success fw-semibold">
                                {{ $attendance->check_in ?? '-' }}
                            </span>
                            </td>

                            <td>
                            <span class="text-danger fw-semibold">
                                {{ $attendance->check_out ?? '-' }}
                            </span>
                            </td>

                            <td>
                            <span class="badge bg-light text-dark border">
                                {{ $attendance->working_hours ?? 0 }} hrs
                            </span>
                            </td>

                            <td>
                                @if($attendance && $attendance->is_late)
                                    <span class="badge bg-danger-subtle text-danger border px-3 py-2">
                                    Late
                                </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border px-3 py-2">
                                    On Time
                                </span>
                                @endif
                            </td>

                            <td>
                                @if($attendance && $attendance->status == 'present')
                                    <span class="badge bg-success px-3 py-2">Present</span>
                                @elseif($attendance && $attendance->status == 'absent')
                                    <span class="badge bg-danger px-3 py-2">Absent</span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2">Not Marked</span>
                                @endif
                            </td>

                            <td class="text-center">

                                <div class="d-flex align-items-center justify-content-center flex-wrap gap-1">

                                    @if(auth()->user()->hasAnyRole(['super-admin', 'hr'])
                                        || auth()->user()->can('attendance.mark.team')
                                        || auth()->user()->can('attendance.mark.self'))

                                        @if(!$attendance || !$attendance->check_in)
                                            <button class="btn  btn-success btn-sm rounded-pill px-3 checkInBtn"
                                                    data-id="{{ $employee->id }}">
                                                Check-In
                                            </button>

                                        @else
                                            <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                                Checked-In
                                            </button>
                                        @endif

                                        @if($attendance && $attendance->check_in && !$attendance->check_out)
                                            <button class="btn btn-danger btn-sm rounded-pill px-3  checkOutBtn"
                                                    data-id="{{ $attendance->id }}">
                                                Check-Out
                                            </button>
                                        @elseif($attendance && $attendance->check_out)
                                            <button class="btn btn-dark btn-sm rounded-pill px-3" disabled>
                                                Completed
                                            </button>
                                        @endif

                                    @endif

                                        @if(auth()->user()->hasAnyRole(['super-admin'])
                                           || auth()->user()->can('attendance.edit.all'))
                                    @if($attendance && $attendance->check_in)
                                        <a href="{{ route('attendance.edit', $attendance->id) }}"
                                           class="btn btn-warning btn-sm rounded-pill px-3">
                                            Edit
                                        </a>
                                    @endif
                                        @endif

                                        @if(auth()->user()->hasAnyRole(['super-admin'])
                                        || auth()->user()->can('attendance.approve.team')
                                        || auth()->user()->can('attendance.approve.all'))
                                    @if($attendance && !$attendance->is_approved)
                                        <button class="btn btn-primary btn-sm rounded-pill px-3  approveBtn"
                                                data-id="{{ $attendance->id }}">
                                            Approve
                                        </button>
                                    @elseif($attendance && $attendance->is_approved)
                                        <span class="badge bg-success px-3 py-2">
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
