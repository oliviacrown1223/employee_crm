@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header bg-white">

                <h4 class="fw-bold mb-0">
                    Edit Attendance
                </h4>

            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('hr.attendance.update', $attendance->id) }}">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Employee
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $attendance->employee->name }}"
                                   readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Attendance Date
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $attendance->attendance_date }}"
                                   readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Check In
                            </label>

                            <input type="time"
                                   name="check_in"
                                   class="form-control"
                                   value="{{ $attendance->check_in }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Check Out
                            </label>

                            <input type="time"
                                   name="check_out"
                                   class="form-control"
                                   value="{{ $attendance->check_out }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status"
                                    class="form-select">

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

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Working Hours
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $attendance->working_hours }} hrs"
                                   readonly>

                        </div>

                    </div>

                    <button type="submit"
                            class="btn btn-primary">

                        Update Attendance

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection
