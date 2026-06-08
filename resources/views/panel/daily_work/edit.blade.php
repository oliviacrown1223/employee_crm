@extends('layouts.admin')

@section('page-title', 'Edit Daily Work')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="bg-dark bg-gradient p-4">
                        <h3 class="fw-bold text-white mb-1">
                            Edit Daily Work
                        </h3>

                        <p class="text-white opacity-75 mb-0">
                            Update employee task details professionally
                        </p>
                    </div>

                    <div class="card-body p-4 p-lg-5">

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

                                    <input type="text"
                                           name="task_title"
                                           value="{{ old('task_title', $work->task_title) }}"
                                           class="form-control bg-light border-0 py-3 @error('task_title') is-invalid @enderror">

                                    @error('task_title', 'dailywork')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Hours Worked
                                    </label>

                                    <input type="number"
                                           step="0.1"
                                           name="hours_worked"
                                           id="hours_worked"
                                           value="{{ old('hours_worked', $work->hours_worked) }}"
                                           class="form-control bg-light border-0 py-3 @error('hours_worked') is-invalid @enderror">

                                    @error('hours_worked', 'dailywork')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold mb-2">
                                        Task Description
                                    </label>

                                    <textarea name="task_description"
                                              rows="5"
                                              class="form-control bg-light border-0 py-3 @error('task_description') is-invalid @enderror">{{ old('task_description', $work->task_description) }}</textarea>

                                    @error('task_description', 'dailywork')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Work Date
                                    </label>

                                    <input type="date"
                                           name="work_date"
                                           value="{{ old('work_date', $work->work_date) }}"
                                           class="form-control bg-light border-0 py-3 @error('work_date') is-invalid @enderror">

                                    @error('work_date', 'dailywork')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @hasanyrole('super-admin|manager')
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">
                                        Status
                                    </label>

                                    <select name="status"
                                            class="form-select bg-light border-0 py-3 @error('status') is-invalid @enderror">

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

                                    @error('status', 'dailywork')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endhasanyrole

                                <div class="col-12">
                                    <div class="bg-light border rounded-4 p-4">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                            <div>
                                                <h5 class="fw-bold mb-1">
                                                    Live Work Summary
                                                </h5>

                                                <small class="text-muted">
                                                    Auto updating task preview
                                                </small>
                                            </div>

                                            <div class="text-end">
                                                <div class="fw-bold text-primary fs-4">
                                                    <span id="previewHours">{{ $work->hours_worked }}</span> Hours
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-5 d-flex justify-content-end gap-3">

                                <a href="{{ route('daily-work.index') }}"
                                   class="btn btn-light border px-4 py-3 rounded-pill fw-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-dark px-5 py-3 rounded-pill fw-bold shadow-sm">
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
