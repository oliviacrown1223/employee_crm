@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold">
                Attendance Management
            </h3>

            <!-- BUTTON -->

            <button type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#attendanceModal">

                <i class="bi bi-plus-circle"></i>

                Mark Attendance

            </button>

            <!-- MODAL -->

            <div class="modal fade" id="attendanceModal" tabindex="-1">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title">
                                Mark Attendance
                            </h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                            </button>

                        </div>

                        <div class="modal-body">

                            <form id="attendanceForm">

                                @csrf

                                <!-- EMPLOYEE -->

                                <div class="mb-3">

                                    <label class="form-label">
                                        Employee
                                    </label>

                                    <select name="employee_id"
                                            class="form-select"
                                            required>

                                        <option value="">
                                            Select Employee
                                        </option>

                                        @foreach($employees as $employee)

                                            <option value="{{ $employee->id }}">
                                                {{ $employee->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                                <!-- STATUS -->

                                <div class="mb-3">

                                    <label class="form-label">
                                        Status
                                    </label>

                                    <select name="status"
                                            class="form-select">

                                        <option value="present">
                                            Present
                                        </option>

                                        <option value="absent">
                                            Absent
                                        </option>

                                    </select>

                                </div>

                                <!-- SUBMIT -->

                                <button type="submit"
                                        class="btn btn-primary w-100">

                                    Save Attendance

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- CARDS -->

        <!-- CARDS -->

        <div class="row g-4 mb-5">

            <!-- TOTAL EMPLOYEES -->

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-2 fw-semibold">
                                    Total Employees
                                </p>

                                <h2 class="fw-bold mb-0 text-dark">
                                    {{ $totalEmployees }}
                                </h2>

                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-people-fill text-primary fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PRESENT -->

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-2 fw-semibold">
                                    Present Today
                                </p>

                                <h2 class="fw-bold mb-0 text-success">
                                    {{ $presentToday }}
                                </h2>

                            </div>

                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-check-circle-fill text-success fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ABSENT -->

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-2 fw-semibold">
                                    Absent Today
                                </p>

                                <h2 class="fw-bold mb-0 text-danger">
                                    {{ $absentToday }}
                                </h2>

                            </div>

                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-x-circle-fill text-danger fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- LATE -->

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted mb-2 fw-semibold">
                                    Late Today
                                </p>

                                <h2 class="fw-bold mb-0 text-warning">
                                    {{ $lateToday }}
                                </h2>

                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-alarm-fill text-warning fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE -->

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="card-header bg-white border-0 py-3 px-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-1 fw-bold">Attendance Records</h5>
                        <small class="text-muted">Manage employee attendance activity</small>
                    </div>

                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                        {{ $attendances->count() }} Records
                    </span>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table align-middle mb-0 attendance-table">

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

                                <div class="d-flex align-items-center gap-2">

                                    <div>
                                        <h6 class="mb-0 fw-semibold">
                                            {{ $employee->name }}
                                        </h6>
                                    </div>

                                </div>

                            </td>

                            {{-- DATE --}}
                            <td>
            <span class="fw-medium">
                {{ $attendance->attendance_date ?? '-' }}
            </span>
                            </td>

                            {{-- CHECK IN --}}
                            <td>
            <span class="text-success fw-semibold">
                {{ $attendance->check_in ?? '-' }}
            </span>
                            </td>

                            {{-- CHECK OUT --}}
                            <td>
            <span class="text-danger fw-semibold">
                {{ $attendance->check_out ?? '-' }}
            </span>
                            </td>

                            {{-- WORKING HOURS --}}
                            <td>
            <span class="badge bg-light text-dark border">
                {{ $attendance->working_hours ?? 0 }} hrs
            </span>
                            </td>

                            {{-- LATE --}}
                            <td>
                                @if($attendance && $attendance->is_late)
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                    Late
                </span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                    On Time
                </span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($attendance && $attendance->status == 'present')
                                    <span class="badge bg-success px-3 py-2">
                    Present
                </span>
                                @else
                                    <span class="badge bg-danger px-3 py-2">
                    Absent
                </span>
                                @endif
                            </td>

                            {{-- ACTIONS --}}
                            <td class="text-center action-column">

                                <div class="d-flex align-items-center justify-content-center flex-wrap gap-1">

                                    {{-- CHECK-IN --}}
                                    @if(!$attendance || !$attendance->check_in)

                                        <button class="btn btn-success btn-sm rounded-pill px-3 checkInBtn"
                                                data-id="{{ $employee->id }}">
                                            Check-In
                                        </button>

                                    @else

                                        <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                            Checked-In
                                        </button>

                                    @endif

                                    {{-- CHECK-OUT --}}
                                    @if($attendance && $attendance->check_in && !$attendance->check_out)

                                        <button class="btn btn-danger btn-sm rounded-pill px-3 checkOutBtn"
                                                data-id="{{ $attendance->id }}">
                                            Check-Out
                                        </button>

                                    @elseif($attendance && $attendance->check_out)

                                        <button class="btn btn-dark btn-sm rounded-pill px-3" disabled>
                                            Completed
                                        </button>

                                    @endif

                                    {{-- EDIT --}}
                                    {{-- EDIT --}}
                                    @if($attendance && $attendance->check_in)
                                        <a href="{{ route('attendance.edit', $attendance->id) }}"
                                           class="btn btn-warning btn-sm rounded-pill px-3">
                                            Edit
                                        </a>
                                    @endif

                                    {{-- APPROVE --}}
                                    @if($attendance && !$attendance->is_approved)

                                        <button class="btn btn-primary btn-sm rounded-pill px-3 approveBtn"
                                                data-id="{{ $attendance->id }}">
                                            Approve
                                        </button>

                                    @elseif($attendance && $attendance->is_approved)

                                        <span class="badge bg-success px-3 py-2">
                        Approved
                    </span>

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

                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <h5 class="fw-bold">No Attendance Found</h5>
                            </td>
                        </tr>



                    </tbody>

                </table>

            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>

        $('#attendanceForm').submit(function(e){

            e.preventDefault();

            $.ajax({

                url: "{{ route('attendance.mark') }}",

                type: "POST",

                data: $(this).serialize(),

                success: function(response){

                },

                error: function(xhr){

                    console.log(xhr.responseText);

                    alert('Something went wrong');
                }

            });

        });

    </script>
@endsection
