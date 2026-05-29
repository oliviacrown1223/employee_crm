@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">Edit Leave</h2>
                <p class="text-muted mb-0">Update your leave request details</p>
            </div>

        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white py-4 border-0">

                <h5 class="mb-0 fw-semibold">Leave Form</h5>
                <small class="text-light opacity-75">Modify and update your leave request</small>

            </div>

            <!-- BODY -->
            <div class="card-body p-4">

                <form method="POST"
                      action="{{ route('employee.leave.update', $leave->id) }}">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <!-- LEAVE TYPE -->
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">Leave Type</label>

                            <select name="leave_type"
                                    class="form-select rounded-3 shadow-sm">

                                <option value="Sick Leave"
                                    {{ $leave->leave_type == 'Sick Leave' ? 'selected' : '' }}>
                                    Sick Leave
                                </option>

                                <option value="Casual Leave"
                                    {{ $leave->leave_type == 'Casual Leave' ? 'selected' : '' }}>
                                    Casual Leave
                                </option>

                                <option value="Emergency Leave"
                                    {{ $leave->leave_type == 'Emergency Leave' ? 'selected' : '' }}>
                                    Emergency Leave
                                </option>

                            </select>

                        </div>

                        <!-- LEAVE DATE -->
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">Leave Date</label>

                            <input type="date"
                                   name="leave_date"
                                   value="{{ $leave->leave_date }}"
                                   class="form-control rounded-3 shadow-sm">

                        </div>

                        <!-- REASON -->
                        <div class="col-12">

                            <label class="form-label fw-semibold">Reason</label>

                            <textarea name="reason"
                                      rows="4"
                                      class="form-control rounded-3 shadow-sm"
                                      placeholder="Enter reason for leave...">{{ $leave->reason }}</textarea>

                        </div>

                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a href="{{ route('employee.leave.index') }}"
                           class="btn btn-outline-secondary rounded-pill px-4">

                            Back

                        </a>

                        <button type="submit"
                                class="btn btn-primary rounded-pill px-4 shadow-sm">

                            <i class="bi bi-check-circle me-1"></i>
                            Update Leave

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
