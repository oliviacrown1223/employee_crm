@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- HEADER --}}
                    <div class="bg-success bg-gradient p-4 position-relative">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h3 class="fw-bold text-white mb-1">
                                    Employee Performance Rating
                                </h3>

                                <p class="text-white opacity-75 mb-0">
                                    Generate and manage employee performance scores professionally
                                </p>

                            </div>

                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                 style="width:70px;height:70px;font-size:30px;">

                                📈

                            </div>

                        </div>

                        {{-- DECORATIVE --}}
                        <div class="position-absolute top-0 end-0 translate-middle-y opacity-10"
                             style="width:220px;height:220px;background:#fff;border-radius:50%;">
                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-4 p-lg-5">

                        <form method="POST"
                              action="{{ route('performance.store') }}"
                              id="performanceForm">

                            @csrf

                            <div class="row g-4">

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
                                                class="form-select border-0 bg-light rounded-end-4 py-3 @error('employee_id', 'performance') is-invalid @enderror">

                                            <option value="">
                                                Select Employee
                                            </option>

                                            @foreach($employees as $e)

                                                <option value="{{ $e->id }}"
                                                    {{ old('employee_id') == $e->id ? 'selected' : '' }}>

                                                    {{ $e->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('employee_id', 'performance')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- MONTH --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold mb-2">
                                        Performance Month
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        📅
                                    </span>

                                        <input type="month"
                                               name="month"
                                               id="month"
                                               value="{{ old('month') }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('month', 'performance') is-invalid @enderror">

                                    </div>

                                    @error('month', 'performance')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- ATTENDANCE --}}
                                <div class="col-md-4">

                                    <label class="form-label fw-semibold mb-2">
                                        Attendance Score
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        🟢
                                    </span>

                                        <input type="number"
                                               name="attendance_score"
                                               id="attendance_score"
                                               value="{{ old('attendance_score') }}"
                                               placeholder="0 - 100"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('attendance_score', 'performance') is-invalid @enderror">

                                    </div>

                                    @error('attendance_score', 'performance')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- TASK COMPLETION --}}
                                <div class="col-md-4">

                                    <label class="form-label fw-semibold mb-2">
                                        Task Completion
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        ✅
                                    </span>

                                        <input type="number"
                                               name="task_completion_score"
                                               id="task_completion_score"
                                               value="{{ old('task_completion_score') }}"
                                               placeholder="0 - 100"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('task_completion_score', 'performance') is-invalid @enderror">

                                    </div>

                                    @error('task_completion_score', 'performance')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- MANAGER RATING --}}
                                <div class="col-md-4">

                                    <label class="form-label fw-semibold mb-2">
                                        Manager Rating
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        ⭐
                                    </span>

                                        <input type="number"
                                               name="manager_rating"
                                               id="manager_rating"
                                               value="{{ old('manager_rating') }}"
                                               placeholder="0 - 5"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('manager_rating', 'performance') is-invalid @enderror">

                                    </div>

                                    @error('manager_rating', 'performance')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- LIVE RESULT --}}
                                <div class="col-12">

                                    <div class="bg-light border rounded-4 p-4">

                                        <div class="row text-center">

                                            <div class="col-md-6 border-end">

                                                <h6 class="text-muted mb-2">
                                                    Final Rating
                                                </h6>

                                                <h2 class="fw-bold text-success mb-0">

                                                    <span id="finalRating">0</span>%

                                                </h2>

                                            </div>

                                            <div class="col-md-6">

                                                <h6 class="text-muted mb-2">
                                                    Performance Grade
                                                </h6>

                                                <h2 class="fw-bold text-primary mb-0"
                                                    id="performanceGrade">

                                                    -

                                                </h2>

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
                                        class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow-sm">

                                    Generate Rating

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- LIVE CALCULATION + VALIDATION --}}
    <script>



    </script>

@endsection
