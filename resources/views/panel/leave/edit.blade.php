@extends('layouts.admin')

@section('page-title', 'Edit Leave')

@section('content')

    <div class="container-fluid py-4 leave-edit-page">

        <div class="leave-edit-hero mb-4">

            <div>
            <span class="leave-edit-badge">
                <i class="bi bi-pencil-square me-1"></i>
                Leave Module
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Edit Leave
                </h2>

                <p class="mb-0 opacity-75">
                    Update leave request details
                </p>
            </div>

            <a href="{{ route('leave.index') }}"
               class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="row justify-content-center">

            <div class="col-xl-8">

                <div class="leave-edit-card">

                    <div class="leave-edit-card-header">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Leave Information
                            </h5>

                            <small class="text-muted">
                                Modify leave details before approval
                            </small>
                        </div>

                        <div class="leave-edit-icon">
                            <i class="bi bi-calendar2-week"></i>
                        </div>

                    </div>

                    <div class="leave-edit-body">

                        <form method="POST"
                              action="{{ route('leave.update', $leave->id) }}"
                              class="update-confirm">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Leave Type
                                    </label>

                                    <div class="leave-input-box">

                                        <i class="bi bi-calendar-range"></i>

                                        <select name="leave_type"
                                                class="form-select leave-input @error('leave_type') is-invalid @enderror">

                                            <option value="">Select Leave Type</option>

                                            <option value="Sick Leave"
                                                {{ old('leave_type', $leave->leave_type) == 'Sick Leave' ? 'selected' : '' }}>
                                                Sick Leave
                                            </option>

                                            <option value="Casual Leave"
                                                {{ old('leave_type', $leave->leave_type) == 'Casual Leave' ? 'selected' : '' }}>
                                                Casual Leave
                                            </option>

                                            <option value="Emergency Leave"
                                                {{ old('leave_type', $leave->leave_type) == 'Emergency Leave' ? 'selected' : '' }}>
                                                Emergency Leave
                                            </option>

                                        </select>

                                    </div>

                                    @error('leave_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Leave Date
                                    </label>

                                    <div class="leave-input-box">

                                        <i class="bi bi-calendar-event"></i>

                                        <input type="date"
                                               name="leave_date"
                                               value="{{ old('leave_date', $leave->leave_date) }}"
                                               class="form-control leave-input @error('leave_date') is-invalid @enderror">

                                    </div>

                                    @error('leave_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-12">

                                    <label class="form-label fw-semibold">
                                        Reason
                                    </label>

                                    <div class="leave-input-box textarea-box">

                                        <i class="bi bi-chat-left-text"></i>

                                        <textarea name="reason"
                                                  rows="5"
                                                  class="form-control leave-input @error('reason') is-invalid @enderror">{{ old('reason', $leave->reason) }}</textarea>

                                    </div>

                                    @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                            <div class="leave-edit-actions mt-5">

                                <a href="{{ route('leave.index') }}"
                                   class="btn btn-light border rounded-pill px-5 py-3">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-dark rounded-pill px-5 py-3 fw-bold shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Update Leave
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
