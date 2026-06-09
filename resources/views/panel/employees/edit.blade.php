@extends('layouts.admin')

@section('page-title', 'Edit Employee')

@section('content')

    <div class="container-fluid py-4 employee-edit-page">

        <div class="employee-edit-header mb-4">

            <div>
            <span class="page-badge">
                <i class="bi bi-pencil-square me-1"></i>
                Employee Module
            </span>

                <h2 class="fw-bold mt-3 mb-1">
                    Edit Employee
                </h2>

                <p class="text-light opacity-75 mb-0">
                    Update employee profile details
                </p>
            </div>

            <a href="{{ route('employees.index') }}"
               class="btn btn-light rounded-pill px-4 shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="employee-form-card">

            <div class="card-body p-4">

                <div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">

                    <div>
                        <h4 class="fw-bold mb-1">
                            Employee Information
                        </h4>

                        <small class="text-muted">
                            Update all required details carefully.
                        </small>
                    </div>

                    <div class="current-photo-box">
                        @if($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                 class="current-photo-img">
                        @else
                            <div class="current-photo-initial">
                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                </div>

                <form method="POST"
                      action="{{ route('employees.update', $employee->id) }}"
                      enctype="multipart/form-data"
                      class="update-confirm">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Employee Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $employee->name) }}"
                                   class="form-control premium-employee-input @error('name') is-invalid @enderror">

                            @error('name')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $employee->email) }}"
                                   class="form-control premium-employee-input @error('email') is-invalid @enderror">

                            @error('email')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mobile</label>
                            <input type="text"
                                   name="mobile"
                                   value="{{ old('mobile', $employee->mobile) }}"
                                   class="form-control premium-employee-input @error('mobile') is-invalid @enderror">

                            @error('mobile')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text"
                                   name="department"
                                   value="{{ old('department', $employee->department) }}"
                                   class="form-control premium-employee-input">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Designation</label>
                            <input type="text"
                                   name="designation"
                                   value="{{ old('designation', $employee->designation) }}"
                                   class="form-control premium-employee-input">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Salary</label>
                            <input type="number"
                                   name="salary"
                                   value="{{ old('salary', $employee->salary) }}"
                                   class="form-control premium-employee-input">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Joining Date</label>
                            <input type="date"
                                   name="joining_date"
                                   value="{{ old('joining_date', $employee->joining_date) }}"
                                   class="form-control premium-employee-input">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select premium-employee-input">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control premium-employee-input">{{ old('address', $employee->address) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Profile Photo</label>
                            <input type="file"
                                   name="photo"
                                   class="form-control premium-employee-input @error('photo') is-invalid @enderror">

                            @error('photo')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Photo</label>

                            <div class="photo-preview-card">
                                @if($employee->photo)
                                    <img src="{{ asset('storage/' . $employee->photo) }}"
                                         class="photo-preview-img">
                                @else
                                    <span class="text-muted">No photo</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="employee-form-actions mt-5">

                        <button type="submit"
                                class="btn btn-primary rounded-pill px-5 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i>
                            Update Employee
                        </button>

                        <a href="{{ route('employees.index') }}"
                           class="btn btn-light border rounded-pill px-5">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
