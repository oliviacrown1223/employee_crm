@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- HEADER --}}
                    <div class="bg-dark bg-gradient p-4 position-relative">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h3 class="fw-bold text-white mb-1">
                                    Edit Daily Work
                                </h3>

                                <p class="text-white opacity-75 mb-0">
                                    Update employee task details professionally
                                </p>

                            </div>

                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                 style="width:70px;height:70px;font-size:30px;">

                                ✏️

                            </div>

                        </div>

                        {{-- DECORATIVE CIRCLE --}}
                        <div class="position-absolute top-0 end-0 translate-middle-y opacity-10"
                             style="width:220px;height:220px;background:#fff;border-radius:50%;">
                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-4 p-lg-5">

                        <form method="POST"
                              action="{{ route('daily-work.update', $work->id) }}"
                              id="editDailyWorkForm">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                {{-- TASK TITLE --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">
                                        Task Title
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        📝
                                    </span>

                                        <input type="text"
                                               name="task_title"
                                               id="task_title"
                                               value="{{ old('task_title', $work->task_title) }}"
                                               placeholder="Enter Task Title"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('task_title') is-invalid @enderror">

                                    </div>

                                    @error('task_title', 'dailywork')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- HOURS WORKED --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">
                                        Hours Worked
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        ⏰
                                    </span>

                                        <input type="number"
                                               step="0.1"
                                               name="hours_worked"
                                               id="hours_worked"
                                               value="{{ old('hours_worked', $work->hours_worked) }}"
                                               placeholder="Enter Hours Worked"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('hours_worked') is-invalid @enderror">

                                    </div>

                                    @error('hours_worked')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- TASK DESCRIPTION --}}
                                <div class="col-12">

                                    <label class="form-label fw-semibold mb-2">
                                        Task Description
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4 align-items-start pt-3">
                                        📄
                                    </span>

                                        <textarea name="task_description"
                                                  id="task_description"
                                                  rows="5"
                                                  placeholder="Enter detailed task description..."
                                                  class="form-control border-0 bg-light rounded-end-4 py-3 @error('task_description') is-invalid @enderror">{{ old('task_description', $work->task_description) }}</textarea>

                                    </div>

                                    @error('task_description')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- WORK DATE --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">
                                        Work Date
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        📅
                                    </span>

                                        <input type="date"
                                        name="submission_date"
                                               id="work_date"
                                               value="{{ old('work_date', $work->work_date) }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('work_date') is-invalid @enderror">

                                    </div>

                                    @error('work_date')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- STATUS --}}
                                @if(auth()->user()->role != 'employee')

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold mb-2">
                                            Status
                                        </label>

                                        <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        📌
                                    </span>

                                            <select name="status"
                                                    id="status"
                                                    class="form-select border-0 bg-light rounded-end-4 py-3 @error('status') is-invalid @enderror">

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

                                        @error('status')

                                        <div class="text-danger small mt-2 fw-semibold">
                                            {{ $message }}
                                        </div>

                                        @enderror

                                    </div>

                                @endif

                                {{-- LIVE PREVIEW --}}
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
                                                    <span id="previewHours">0</span> Hours
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- BUTTONS --}}
                            <div class="mt-5 d-flex justify-content-end gap-3">

                                <a href="{{ url()->previous() }}"
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

    {{-- LIVE VALIDATION + LIVE PREVIEW --}}
    <script>


    </script>

@endsection
