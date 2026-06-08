@extends('layouts.admin')

@section('page-title', 'Edit Performance')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="bg-dark bg-gradient p-4">
                        <h3 class="fw-bold text-white mb-1">
                            Edit Employee Performance
                        </h3>
                        <p class="text-white opacity-75 mb-0">
                            Update performance evaluation, KPI scores & ratings
                        </p>
                    </div>

                    <div class="card-body p-4 p-lg-5">

                        <form method="POST"
                              action="{{ route('performance.update', $performance->id) }}"
                              id="performanceEditForm"
                              class="update-confirm">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">Employee</label>

                                    <select name="employee_id"
                                            class="form-select py-3">
                                        <option value="">Select Employee</option>

                                        @foreach($employees as $e)
                                            <option value="{{ $e->id }}"
                                                {{ old('employee_id', $performance->employee_id) == $e->id ? 'selected' : '' }}>
                                                {{ $e->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold mb-2">Performance Month</label>

                                    <input type="month"
                                           name="month"
                                           value="{{ old('month', $performance->month) }}"
                                           class="form-control py-3">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-2">Attendance Score</label>

                                    <input type="number"
                                           name="attendance_score"
                                           id="attendance_score"
                                           value="{{ old('attendance_score', $performance->attendance_score) }}"
                                           class="form-control py-3">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-2">Task Completion</label>

                                    <input type="number"
                                           name="task_completion_score"
                                           id="task_completion_score"
                                           value="{{ old('task_completion_score', $performance->task_completion_score) }}"
                                           class="form-control py-3">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-2">Manager Rating</label>


                                    <input type="number"
                                           name="manager_rating"
                                           id="manager_rating"
                                           value="{{ old('manager_rating', $performance->manager_rating) }}"
                                           min="1"
                                           max="5"
                                           class="form-control py-3">

                                    @error('manager_rating', 'performance')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">

                                    <div class="bg-light border rounded-4 p-4">

                                        <div class="row text-center">

                                            <div class="col-md-6 border-end">
                                                <h6 class="text-muted mb-2">Final Rating</h6>
                                                <h2 class="fw-bold text-success mb-0">
                                                    <span id="finalRating">0</span>%
                                                </h2>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="text-muted mb-2">Performance Grade</h6>
                                                <h2 class="fw-bold text-primary mb-0"
                                                    id="performanceGrade">-</h2>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="mt-5 d-flex justify-content-end gap-3">

                                <a href="{{ route('performance.index') }}"
                                   class="btn btn-light border px-4 py-3 rounded-pill fw-semibold">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-dark px-5 py-3 rounded-pill fw-bold shadow-sm">
                                    Update Performance
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
