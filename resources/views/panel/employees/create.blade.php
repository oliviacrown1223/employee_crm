@extends('layouts.admin')

@section('page-title', 'Add Employee')

@section('content')

    <div class="container-fluid">

        <div class="employee-create-header mb-4">

            <div>
        <span class="page-badge">
            <i class="bi bi-person-plus-fill me-1"></i>
            Employee Module
        </span>

                <h2 class="fw-bold mt-3 mb-1">
                    Add Employee
                </h2>

                <p class="text-light opacity-75 mb-0">
                    Create new employee profile
                </p>
            </div>

            <a href="{{ route('employees.index') }}"
               class="btn btn-light rounded-pill px-4 shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="employee-form-card">
            <div class="card-body">
                <div class="mb-4">

                    <h4 class="fw-bold mb-1">
                        Employee Information
                    </h4>

                    <small class="text-muted">
                        Fill all required details carefully.
                    </small>

                </div>
                <form method="POST"
                      action="{{ route('employees.store') }}"
                      enctype="multipart/form-data"
                      id="employeeCreateForm"
                      class="create-confirm"
                      novalidate>

                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Employee Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control rounded-3 @error('name') is-invalid @enderror"
                                   maxlength="50">
                            <small class="text-danger error-message">@error('name'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control rounded-3 @error('email') is-invalid @enderror"
                                   maxlength="100">
                            <small class="text-danger error-message">@error('email'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}"
                                   class="form-control rounded-3 @error('mobile') is-invalid @enderror"
                                   maxlength="10">
                            <small class="text-danger error-message">@error('mobile'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department" value="{{ old('department') }}"
                                   class="form-control rounded-3 @error('department') is-invalid @enderror"
                                   maxlength="50">
                            <small class="text-danger error-message">@error('department'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Designation</label>
                            <input type="text" name="designation" value="{{ old('designation') }}"
                                   class="form-control rounded-3 @error('designation') is-invalid @enderror"
                                   maxlength="50">
                            <small class="text-danger error-message">@error('designation'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Salary</label>
                            <input type="number" name="salary" value="{{ old('salary') }}"
                                   class="form-control rounded-3 @error('salary') is-invalid @enderror"
                                   min="1" max="10000000" step="0.01">
                            <small class="text-danger error-message">@error('salary'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Joining Date</label>
                            <input type="date" name="joining_date" value="{{ old('joining_date') }}"
                                   class="form-control rounded-3 @error('joining_date') is-invalid @enderror"
                                   max="{{ date('Y-m-d') }}">
                            <small class="text-danger error-message">@error('joining_date'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status"
                                    class="form-select rounded-3 @error('status') is-invalid @enderror">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <small class="text-danger error-message">@error('status'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" rows="3"
                                      class="form-control rounded-3 @error('address') is-invalid @enderror"
                                      maxlength="255">{{ old('address') }}</textarea>
                            <small class="text-danger error-message">@error('address'){{ $message }}@enderror</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Profile Photo</label>
                            <input type="file" name="photo"
                                   accept=".jpg,.jpeg,.png,.webp"
                                   class="form-control rounded-3 @error('photo') is-invalid @enderror">
                            <small class="text-danger error-message">@error('photo'){{ $message }}@enderror</small>
                        </div>

                    </div>

                    <div class="employee-btn-group mt-5">
                        <button type="submit"
                                class="btn btn-primary px-5 rounded-pill shadow-sm">

                            <i class="bi bi-save me-1"></i>
                            Save Employee

                        </button>

                        <a href="{{ route('employees.index') }}"
                           class="btn btn-light border px-5 rounded-pill">

                            Cancel

                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('employeeCreateForm');

            function setError(input, message) {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');

                let error = input.closest('div').querySelector('.error-message');
                if (error) error.innerText = message;
            }

            function setSuccess(input) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');

                let error = input.closest('div').querySelector('.error-message');
                if (error) error.innerText = '';
            }

            function validateField(input) {
                let name = input.name;
                let value = input.value.trim();

                if (name === 'name') {
                    input.value = input.value.replace(/[^A-Za-z ]/g, '');
                    if (value === '') return setError(input, 'Employee name is required'), false;
                    if (value.length < 3) return setError(input, 'Employee name minimum 3 characters'), false;
                }

                if (name === 'email') {
                    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (value === '') return setError(input, 'Email is required'), false;
                    if (!emailPattern.test(value)) return setError(input, 'Enter valid email address'), false;
                }

                if (name === 'mobile') {
                    input.value = input.value.replace(/[^0-9]/g, '');
                    if (input.value === '') return setError(input, 'Mobile number is required'), false;
                    if (input.value.length !== 10) return setError(input, 'Mobile number must be 10 digits'), false;
                }

                if (name === 'department') {
                    input.value = input.value.replace(/[^A-Za-z ]/g, '');
                    if (value === '') return setError(input, 'Department is required'), false;
                }

                if (name === 'designation') {
                    if (value === '') return setError(input, 'Designation is required'), false;
                }

                if (name === 'salary') {
                    if (value === '') return setError(input, 'Salary is required'), false;
                    if (parseFloat(value) <= 0) return setError(input, 'Salary must be greater than 0'), false;
                }

                if (name === 'joining_date') {
                    if (value === '') return setError(input, 'Joining date is required'), false;
                }

                if (name === 'status') {
                    if (value === '') return setError(input, 'Please select status'), false;
                }

                if (name === 'address') {
                    if (value === '') return setError(input, 'Address is required'), false;
                    if (value.length < 5) return setError(input, 'Address minimum 5 characters'), false;
                }

                if (name === 'photo') {
                    if (input.files.length > 0) {
                        let file = input.files[0];
                        let allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

                        if (!allowed.includes(file.type)) {
                            return setError(input, 'Only jpg, jpeg, png, webp image allowed'), false;
                        }

                        if (file.size > 2 * 1024 * 1024) {
                            return setError(input, 'Photo size maximum 2MB allowed'), false;
                        }
                    }
                }

                setSuccess(input);
                return true;
            }

            form.querySelectorAll('input, select, textarea').forEach(function (input) {
                input.addEventListener('input', function () {
                    validateField(input);
                });

                input.addEventListener('change', function () {
                    validateField(input);
                });
            });

            form.addEventListener('submit', function (e) {
                let isValid = true;

                form.querySelectorAll('input, select, textarea').forEach(function (input) {
                    if (!validateField(input)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    e.stopPropagation();

                    let firstError = form.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.focus();
                    }
                }
            });

        });
    </script>
@endsection
