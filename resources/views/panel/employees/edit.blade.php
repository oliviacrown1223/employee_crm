@extends('layouts.admin')

@section('page-title', 'Edit Employee')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-1">Edit Employee</h3>
                <p class="text-muted mb-0">Update employee profile details</p>
            </div>

            <a href="{{ route('employees.index') }}"
               class="btn btn-outline-dark rounded-3">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">

                <form method="POST"
                      action="{{ route('employees.update', $employee->id) }}"
                      enctype="multipart/form-data"
                class="update-confirm">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Employee Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $employee->name) }}"
                                   class="form-control rounded-3 @error('name') is-invalid @enderror">

                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $employee->email) }}"
                                   class="form-control rounded-3 @error('email') is-invalid @enderror">

                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mobile</label>
                            <input type="text"
                                   name="mobile"
                                   value="{{ old('mobile', $employee->mobile) }}"
                                   class="form-control rounded-3 @error('mobile') is-invalid @enderror">

                            @error('mobile')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text"
                                   name="department"
                                   value="{{ old('department', $employee->department) }}"
                                   class="form-control rounded-3">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Designation</label>
                            <input type="text"
                                   name="designation"
                                   value="{{ old('designation', $employee->designation) }}"
                                   class="form-control rounded-3">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Salary</label>
                            <input type="number"
                                   name="salary"
                                   value="{{ old('salary', $employee->salary) }}"
                                   class="form-control rounded-3">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Joining Date</label>
                            <input type="date"
                                   name="joining_date"
                                   value="{{ old('joining_date', $employee->joining_date) }}"
                                   class="form-control rounded-3">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select rounded-3">
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
                                      class="form-control rounded-3">{{ old('address', $employee->address) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Profile Photo</label>
                            <input type="file"
                                   name="photo"
                                   class="form-control rounded-3 @error('photo') is-invalid @enderror">

                            @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Photo</label>

                            <div>
                                @if($employee->photo)
                                    <img src="{{ asset('storage/' . $employee->photo) }}"
                                         width="80"
                                         height="80"
                                         class="rounded-circle border"
                                         style="object-fit: cover;">
                                @else
                                    <span class="text-muted">No photo</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="mt-4 d-flex gap-2">

                        <button type="submit"
                                class="btn btn-primary rounded-3 px-4">
                            <i class="bi bi-check-circle me-1"></i>
                            Update Employee
                        </button>

                        <a href="{{ route('employees.index') }}"
                           class="btn btn-light border rounded-3 px-4">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
