@extends('layouts.admin')

@section('page-title', 'Generate Performance')

@section('content')

    <div class="container-fluid py-4 performance-create-page">

        <div class="performance-create-hero mb-4">

            <div>
            <span class="performance-create-badge">
                <i class="bi bi-stars me-1"></i>
                Performance Module
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Employee Performance Rating
                </h2>

                <p class="mb-0 opacity-75">
                    Generate and manage employee performance scores professionally
                </p>
            </div>

            <a href="{{ route('performance.index') }}"
               class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="performance-create-card">

                    <div class="performance-create-card-header">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Performance Information
                            </h5>

                            <small class="text-muted">
                                Fill employee monthly performance details
                            </small>
                        </div>

                        <div class="performance-create-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>

                    </div>

                    <div class="performance-create-body">

                        <form method="POST"
                              action="{{ route('performance.store') }}"
                              id="performanceForm"
                              class="create-confirm">

                            @csrf

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">Select Employee</label>

                                    <div class="performance-input-box">
                                        <i class="bi bi-person"></i>

                                        <select name="employee_id"
                                                class="form-select performance-input @error('employee_id', 'performance') is-invalid @enderror">
                                            <option value="">Select Employee</option>

                                            @foreach($employees as $e)
                                                <option value="{{ $e->id }}"
                                                    {{ old('employee_id') == $e->id ? 'selected' : '' }}>
                                                    {{ $e->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('employee_id', 'performance')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">Performance Month</label>

                                    <div class="performance-input-box">
                                        <i class="bi bi-calendar-month"></i>

                                        <input type="month"
                                               name="month"
                                               value="{{ old('month') }}"
                                               class="form-control performance-input @error('month', 'performance') is-invalid @enderror">
                                    </div>

                                    @error('month', 'performance')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-2">Attendance Score</label>

                                    <div class="performance-input-box">
                                        <i class="bi bi-calendar-check"></i>

                                        <input type="number"
                                               name="attendance_score"
                                               id="attendance_score"
                                               value="{{ old('attendance_score') }}"
                                               placeholder="0 - 100"
                                               class="form-control performance-input @error('attendance_score', 'performance') is-invalid @enderror">
                                    </div>

                                    @error('attendance_score', 'performance')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-2">Task Completion</label>

                                    <div class="performance-input-box">
                                        <i class="bi bi-list-check"></i>

                                        <input type="number"
                                               name="task_completion_score"
                                               id="task_completion_score"
                                               value="{{ old('task_completion_score') }}"
                                               placeholder="0 - 100"
                                               class="form-control performance-input @error('task_completion_score', 'performance') is-invalid @enderror">
                                    </div>

                                    @error('task_completion_score', 'performance')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-2">Manager Rating</label>

                                    <div class="performance-input-box">
                                        <i class="bi bi-star"></i>

                                        <input type="number"
                                               name="manager_rating"
                                               id="manager_rating"
                                               value="{{ old('manager_rating') }}"
                                               min="1"
                                               max="5"
                                               placeholder="1 - 5"
                                               class="form-control performance-input @error('manager_rating', 'performance') is-invalid @enderror">
                                    </div>

                                    @error('manager_rating', 'performance')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">

                                    <div class="performance-preview-card">

                                        <div class="performance-preview-item">
                                            <span>Final Rating</span>
                                            <h2>
                                                <span id="finalRating">0</span>%
                                            </h2>
                                        </div>

                                        <div class="performance-preview-divider"></div>

                                        <div class="performance-preview-item">
                                            <span>Performance Grade</span>
                                            <h2 id="performanceGrade">
                                                -
                                            </h2>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="performance-create-actions mt-5">

                                <a href="{{ route('performance.index') }}"
                                   class="btn btn-light border rounded-pill px-5 py-3 fw-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-success rounded-pill px-5 py-3 fw-bold shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Generate Rating
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function getGrade(rating) {
            if (rating >= 80) return 'A';
            if (rating >= 60) return 'B';
            return 'C';
        }

        function calculatePerformance() {
            let attendance = parseFloat(document.getElementById('attendance_score').value) || 0;
            let task = parseFloat(document.getElementById('task_completion_score').value) || 0;
            let manager = parseFloat(document.getElementById('manager_rating').value) || 0;

            let rating = ((attendance + task + manager) / 3).toFixed(1);

            document.getElementById('finalRating').innerText = rating;
            document.getElementById('performanceGrade').innerText = getGrade(rating);
        }

        document.getElementById('attendance_score').addEventListener('input', calculatePerformance);
        document.getElementById('task_completion_score').addEventListener('input', calculatePerformance);
        document.getElementById('manager_rating').addEventListener('input', calculatePerformance);

        calculatePerformance();
    </script>

@endsection
