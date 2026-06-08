@extends('layouts.admin')

@section('page-title', 'Apply Leave')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-8">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="bg-primary bg-gradient p-4">
                        <h3 class="fw-bold text-white mb-1">
                            Apply Leave
                        </h3>

                        <p class="text-white opacity-75 mb-0">
                            Submit employee leave request
                        </p>
                    </div>

                    <div class="card-body p-4 p-lg-5">

                        <form method="POST"
                              action="{{ route('leave.store') }}"
                              class="create-confirm">

                            @csrf

                            <div class="row g-4">

                                @hasanyrole('super-admin|hr')
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">
                                        Employee
                                    </label>

                                    <select name="employee_id"
                                            class="form-select bg-light border-0 py-3 @error('employee_id') is-invalid @enderror">

                                        <option value="">Select Employee</option>

                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('employee_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @endhasanyrole

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Leave Type
                                    </label>

                                    <select name="leave_type"
                                            class="form-select bg-light border-0 py-3 @error('leave_type') is-invalid @enderror">

                                        <option value="">Select Leave Type</option>

                                        <option value="Sick Leave" {{ old('leave_type') == 'Sick Leave' ? 'selected' : '' }}>
                                            Sick Leave
                                        </option>

                                        <option value="Casual Leave" {{ old('leave_type') == 'Casual Leave' ? 'selected' : '' }}>
                                            Casual Leave
                                        </option>

                                        <option value="Emergency Leave" {{ old('leave_type') == 'Emergency Leave' ? 'selected' : '' }}>
                                            Emergency Leave
                                        </option>

                                    </select>

                                    @error('leave_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Leave Date
                                    </label>

                                    <input type="date"
                                           name="leave_date"
                                           value="{{ old('leave_date') }}"
                                           class="form-control bg-light border-0 py-3 @error('leave_date') is-invalid @enderror">

                                    @error('leave_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        Reason
                                    </label>

                                    <textarea name="reason"
                                              rows="5"
                                              class="form-control bg-light border-0 py-3 @error('reason') is-invalid @enderror"
                                              placeholder="Enter leave reason">{{ old('reason') }}</textarea>

                                    @error('reason')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="mt-5 d-flex justify-content-end gap-3">

                                <a href="{{ route('leave.index') }}"
                                   class="btn btn-light border px-4 py-3 rounded-pill">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-primary px-5 py-3 rounded-pill fw-bold">
                                    Apply Leave
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
