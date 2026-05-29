@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- HEADER --}}
                    <div class="bg-primary bg-gradient p-4 position-relative">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h3 class="fw-bold text-white mb-1">
                                    Daily Work Management
                                </h3>

                                <p class="text-white opacity-75 mb-0">
                                    Assign and manage employee daily tasks professionally
                                </p>

                            </div>

                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                 style="width:70px;height:70px;font-size:30px;">

                                📋

                            </div>

                        </div>

                        {{-- Decorative Circle --}}
                        <div class="position-absolute top-0 end-0 translate-middle-y opacity-10"
                             style="width:220px;height:220px;background:#fff;border-radius:50%;">
                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-4 p-lg-5">

                        <form method="POST"
                              action="{{ route('daily-work.store') }}"
                              id="dailyWorkForm">

                            @csrf

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
                                               value="{{ old('task_title') }}"
                                               placeholder="Enter Task Title"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('task_title') is-invalid @enderror">

                                    </div>

                                    @error('task_title')

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
                                               value="{{ old('hours_worked') }}"
                                               placeholder="Enter Hours Worked"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('hours_worked') is-invalid @enderror">

                                    </div>

                                    @error('hours_worked')

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
                                               name="work_date"
                                               id="work_date"
                                               value="{{ old('work_date') }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('work_date') is-invalid @enderror">

                                    </div>

                                    @error('work_date')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- EMPLOYEE --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">
                                        Select Employee
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        👤
                                    </span>

                                        <select name="employee_id"
                                                id="employee_id"
                                                class="form-select border-0 bg-light rounded-end-4 py-3 @error('employee_id') is-invalid @enderror">

                                            <option value="">
                                                Select Employee
                                            </option>

                                            @foreach($employees as $employee)

                                                <option value="{{ $employee->id }}"
                                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>

                                                    {{ $employee->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('employee_id')

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
                                                  class="form-control border-0 bg-light rounded-end-4 py-3 @error('task_description') is-invalid @enderror">{{ old('task_description') }}</textarea>

                                    </div>

                                    @error('task_description')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- LIVE PREVIEW --}}
                                <div class="col-12">

                                    <div class="bg-light border rounded-4 p-4">

                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                            <div>

                                                <h5 class="fw-bold mb-1">
                                                    Work Summary
                                                </h5>

                                                <small class="text-muted">
                                                    Live task preview
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

                            {{-- BUTTON --}}
                            <div class="mt-5 d-flex justify-content-end gap-3">

                                <button type="reset"
                                        class="btn btn-light border px-4 py-3 rounded-pill fw-semibold">

                                    Reset

                                </button>

                                <button type="submit"
                                        class="btn btn-primary px-5 py-3 rounded-pill fw-bold shadow-sm">

                                    Submit Work

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
