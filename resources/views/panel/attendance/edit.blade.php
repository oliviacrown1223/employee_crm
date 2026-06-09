@extends('layouts.admin')

@section('page-title', 'Edit Attendance')

@section('content')

    <div class="container-fluid py-4 attendance-edit-page">

        <div class="attendance-edit-hero mb-4">

            <div>
            <span class="attendance-edit-badge">
                <i class="bi bi-clock-history me-1"></i>
                Attendance Module
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Edit Attendance
                </h2>

                <p class="mb-0 opacity-75">
                    Update employee check-in, check-out and attendance status
                </p>
            </div>

            <a href="{{ route('attendance.index') }}"
               class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="row justify-content-center">

            <div class="col-xl-8 col-lg-9">

                <div class="attendance-edit-card">

                    <div class="attendance-edit-card-header">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Attendance Information
                            </h5>

                            <small class="text-muted">
                                Editing record for
                                <strong>{{ $attendance->employee->name }}</strong>
                            </small>
                        </div>

                        <div class="attendance-edit-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>

                    </div>

                    <div class="attendance-edit-body">

                        <form action="{{ route('attendance.update', $attendance->id) }}"
                              method="POST"
                              class="update-confirm">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">
                                        Employee
                                    </label>

                                    <div class="attendance-input-icon">
                                        <i class="bi bi-person"></i>

                                        <input type="text"
                                               class="form-control attendance-premium-input"
                                               value="{{ $attendance->employee->name }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Check In Time
                                    </label>

                                    <div class="attendance-input-icon">
                                        <i class="bi bi-box-arrow-in-right"></i>

                                        <input type="time"
                                               name="check_in"
                                               class="form-control attendance-premium-input"
                                               step="1"
                                               value="{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i:s') : '' }}"
                                               required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Check Out Time
                                    </label>

                                    <div class="attendance-input-icon">
                                        <i class="bi bi-box-arrow-right"></i>

                                        <input type="time"
                                               name="check_out"
                                               class="form-control attendance-premium-input"
                                               step="1"
                                               value="{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i:s') : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">
                                        Attendance Status
                                    </label>

                                    <div class="attendance-input-icon">
                                        <i class="bi bi-clipboard-check"></i>

                                        <select name="status"
                                                class="form-select attendance-premium-input">

                                            <option value="present"
                                                {{ $attendance->status == 'present' ? 'selected' : '' }}>
                                                Present
                                            </option>

                                            <option value="absent"
                                                {{ $attendance->status == 'absent' ? 'selected' : '' }}>
                                                Absent
                                            </option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="attendance-edit-actions mt-5">

                                <a href="{{ route('attendance.index') }}"
                                   class="btn btn-light border rounded-pill px-5">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-dark rounded-pill px-5 shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Update Attendance
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
