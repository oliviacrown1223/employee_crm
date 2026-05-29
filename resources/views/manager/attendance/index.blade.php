@extends('manager.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold">
                Team Attendance
            </h3>

        </div>

        <!-- CARDS -->

        <!-- CARDS -->

        <div class="row g-4 mb-5">

            <!-- TOTAL TEAM -->

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">
                                    Total Team Members
                                </p>

                                <h2 class="fw-bold text-dark mb-0">
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

                                <p class="text-muted fw-semibold mb-2">
                                    Present Today
                                </p>

                                <h2 class="fw-bold text-success mb-0">
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

                                <p class="text-muted fw-semibold mb-2">
                                    Absent Today
                                </p>

                                <h2 class="fw-bold text-danger mb-0">
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

                                <p class="text-muted fw-semibold mb-2">
                                    Late Today
                                </p>

                                <h2 class="fw-bold text-warning mb-0">
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

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header bg-white">

                <h5 class="fw-bold mb-0">
                    Team Attendance Records
                </h5>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered align-middle mb-0">

                        <thead class="table-light">

                        <tr>

                            <th>Employee</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Hours</th>
                            <th>Status</th>
                            <th>Late</th>
                            <th>Actions</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($employees as $employee)

                            @php
                                $attendance = $employee->attendance->first();
                            @endphp

                            <tr>

                                <td>

                                    {{ $employee->name }}

                                </td>

                                <td>

                                    {{ $attendance->attendance_date ?? '-' }}

                                </td>

                                <td>

                                    {{ $attendance->check_in ?? '-' }}

                                </td>

                                <td>

                                    {{ $attendance->check_out ?? '-' }}

                                </td>

                                <td>

                                    {{ $attendance->working_hours ?? 0 }} hrs

                                </td>

                                <td>

                                    @if($attendance && $attendance->status == 'present')

                                        <span class="badge bg-success">
                                        Present
                                    </span>

                                    @else

                                        <span class="badge bg-danger">
                                        Absent
                                    </span>

                                    @endif

                                </td>

                                <td>

                                    @if($attendance && $attendance->is_late)

                                        <span class="badge bg-danger">
                                        Late
                                    </span>

                                    @else

                                        <span class="badge bg-success">
                                        On Time
                                    </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex gap-1 flex-wrap">

                                        {{-- CHECK IN --}}

                                        @if(!$attendance || !$attendance->check_in)

                                            <button type="button"
                                                    class="btn btn-success btn-sm checkInBtn"
                                                    data-id="{{ $employee->id }}">

                                                Check-In

                                            </button>

                                        @else

                                            <button class="btn btn-secondary btn-sm" disabled>

                                                Checked-In

                                            </button>

                                        @endif

                                        {{-- CHECK OUT --}}

                                        @if($attendance && $attendance->check_in && !$attendance->check_out)

                                            <button type="button"
                                                    class="btn btn-danger btn-sm checkOutBtn"
                                                    data-id="{{ $attendance->id }}">

                                                Check-Out

                                            </button>

                                        @elseif($attendance && $attendance->check_out)

                                            <button class="btn btn-dark btn-sm" disabled>

                                                Completed

                                            </button>

                                        @endif

                                        {{-- APPROVE --}}
                                        @can('attendance.approve.team')

                                            @if($attendance && !$attendance->is_approved)

                                                <button type="button"
                                                        class="btn btn-primary btn-sm approveBtn"
                                                        data-id="{{ $attendance->id }}">

                                                    Approve

                                                </button>

                                            @elseif($attendance && $attendance->is_approved)

                                                <span class="badge bg-success">
                                                  Approved
                                                 </span>

                                            @endif

                                        @else

                                            <button class="btn btn-secondary btn-sm rounded-3" disabled>
                                                Approve
                                            </button>

                                        @endcan


                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-4">

                                    No Team Attendance Found

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>

        $(document).on('click', '.checkInBtn', function(){

            let id = $(this).data('id');

            $.post('/manager/attendance/check-in/' + id, {

                _token: "{{ csrf_token() }}"

            },);

        });

        $(document).on('click', '.checkOutBtn', function(){

            let id = $(this).data('id');

            $.post('/manager/attendance/check-out/' + id, {

                _token: "{{ csrf_token() }}"

            },);

        });

        $(document).on('click', '.approveBtn', function(){

            let id = $(this).data('id');

            $.post('/manager/attendance/approve/' + id, {

                _token: "{{ csrf_token() }}"

            }, );

        });

    </script>

@endsection
