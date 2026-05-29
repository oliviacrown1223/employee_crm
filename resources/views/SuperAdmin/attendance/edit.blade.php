@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-header bg-white border-0 py-3">

                        <h4 class="fw-bold mb-0">

                            Edit Attendance

                        </h4>

                    </div>

                    <div class="card-body p-4">

                        <form action="{{ route('attendance.update', $attendance->id) }}"
                              method="POST">

                            @csrf
                            @method('PUT')

                            <!-- EMPLOYEE -->

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Employee

                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $attendance->employee->name }}"
                                       readonly>

                            </div>

                            <!-- CHECK IN -->

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Check In Time

                                </label>

                                <input type="time"
                                       name="check_in"
                                       class="form-control"
                                       step="1"
                                       value="{{ \Carbon\Carbon::parse($attendance->check_in)->format('H:i:s') }}"
                                       required>

                            </div>



                            <!-- CHECK OUT -->

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Check Out Time

                                </label>

                                <input type="time"
                                       name="check_out"
                                       class="form-control"
                                       step="1"
                                       value="{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i:s') : '' }}">

                            </div>

                            <!-- STATUS -->

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Attendance Status

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

                            <!-- BUTTON -->

                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('attendance.index') }}"
                                   class="btn btn-light px-4">

                                    Cancel

                                </a>


                                <button type="submit"
                                        class="btn btn-dark rounded-3 px-4">

                                    <i class="bi bi-key me-1"></i>

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
