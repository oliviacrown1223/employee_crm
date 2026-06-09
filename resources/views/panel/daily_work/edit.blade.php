@extends('layouts.admin')

@section('page-title', 'Edit Daily Work')

@section('content')

    <div class="container-fluid py-4 daily-create-page daily-edit-page">

        <div class="daily-create-hero daily-edit-hero mb-4">

            <div>
            <span class="daily-create-badge">
                <i class="bi bi-pencil-square me-1"></i>
                Daily Work Module
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Edit Daily Work
                </h2>

                <p class="mb-0 opacity-75">
                    Update employee task details professionally
                </p>
            </div>

            <a href="{{ route('daily-work.index') }}"
               class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="daily-create-card">

                    <div class="daily-create-card-header">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Work Information
                            </h5>

                            <small class="text-muted">
                                Update daily work record
                            </small>
                        </div>

                        <div class="daily-create-icon daily-edit-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>

                    </div>

                    <div class="daily-create-body">

                        <form method="POST"
                              action="{{ route('daily-work.update', $work->id) }}"
                              class="update-confirm">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Task Title
                                    </label>

                                    <div class="daily-create-input-box">
                                        <i class="bi bi-card-text"></i>

                                        <input type="text"
                                               name="task_title"
                                               value="{{ old('task_title', $work->task_title) }}"
                                               class="form-control daily-create-input @error('task_title') is-invalid @enderror">
                                    </div>

                                    @error('task_title', 'dailywork')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Hours Worked
                                    </label>

                                    <div class="daily-create-input-box">
                                        <i class="bi bi-clock"></i>

                                        <input type="number"
                                               step="0.1"
                                               name="hours_worked"
                                               id="hours_worked"
                                               value="{{ old('hours_worked', $work->hours_worked) }}"
                                               class="form-control daily-create-input @error('hours_worked') is-invalid @enderror">
                                    </div>

                                    @error('hours_worked', 'dailywork')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold mb-2">
                                        Task Description
                                    </label>

                                    <div class="daily-create-input-box textarea-box">
                                        <i class="bi bi-file-text"></i>

                                        <textarea name="task_description"
                                                  rows="5"
                                                  class="form-control daily-create-input @error('task_description') is-invalid @enderror">{{ old('task_description', $work->task_description) }}</textarea>
                                    </div>

                                    @error('task_description', 'dailywork')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Work Date
                                    </label>

                                    <div class="daily-create-input-box">
                                        <i class="bi bi-calendar-event"></i>

                                        <input type="date"
                                               name="work_date"
                                               value="{{ old('work_date', $work->work_date) }}"
                                               class="form-control daily-create-input @error('work_date') is-invalid @enderror">
                                    </div>

                                    @error('work_date', 'dailywork')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                @hasanyrole('super-admin|manager')
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Status
                                    </label>

                                    <div class="daily-create-input-box">
                                        <i class="bi bi-flag"></i>

                                        <select name="status"
                                                class="form-select daily-create-input @error('status') is-invalid @enderror">

                                            <option value="draft"
                                                {{ old('status', $work->status) == 'draft' ? 'selected' : '' }}>
                                                Draft
                                            </option>

                                            <option value="pending"
                                                {{ old('status', $work->status) == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>

                                            <option value="approved"
                                                {{ old('status', $work->status) == 'approved' ? 'selected' : '' }}>
                                                Approved
                                            </option>

                                            <option value="rejected"
                                                {{ old('status', $work->status) == 'rejected' ? 'selected' : '' }}>
                                                Rejected
                                            </option>

                                        </select>
                                    </div>

                                    @error('status', 'dailywork')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endhasanyrole

                                <div class="col-12">
                                    <div class="work-summary-card daily-edit-summary">

                                        <div>
                                        <span class="work-summary-label">
                                            Live Work Summary
                                        </span>

                                            <h5 class="fw-bold mb-1">
                                                Auto updating task preview
                                            </h5>

                                            <small>
                                                Total work hours for this task
                                            </small>
                                        </div>

                                        <div class="work-summary-hours">
                                            <span id="previewHours">{{ $work->hours_worked }}</span> Hours
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="daily-create-actions mt-5">

                                <a href="{{ route('daily-work.index') }}"
                                   class="btn btn-light border rounded-pill px-5 py-3 fw-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-dark rounded-pill px-5 py-3 fw-bold shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Update Work
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        const hoursInput = document.getElementById('hours_worked');
        const previewHours = document.getElementById('previewHours');

        if (hoursInput) {
            hoursInput.addEventListener('input', function () {
                previewHours.innerText = this.value || 0;
            });
        }
    </script>

@endsection
