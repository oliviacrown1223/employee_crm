@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">Edit Employee</h2>
                <p class="text-muted mb-0">Update employee details</p>
            </div>

            <a href="{{ route('employees.index') }}" class="btn btn-secondary rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>

        </div>

        <!-- CARD -->
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <<form id="UpdateForm"
                       action="{{ route('employees.update', $employee->id) }}"
                       method="POST"
                       enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- NAME -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name"
                                   value="{{ old('name', $employee->name) }}"
                                   class="form-control rounded-3 @error('name') is-invalid @enderror">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $employee->email) }}"
                                   class="form-control rounded-3 @error('email') is-invalid @enderror">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- MOBILE -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Mobile Number</label>
                            <input type="text" name="mobile"
                                   value="{{ old('mobile', $employee->mobile) }}"
                                   class="form-control rounded-3 @error('mobile') is-invalid @enderror">
                            @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- DEPARTMENT -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Department</label>
                            <input type="text" name="department"
                                   value="{{ old('department', $employee->department) }}"
                                   class="form-control rounded-3 @error('department') is-invalid @enderror">
                            @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- DESIGNATION -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Designation</label>
                            <input type="text" name="designation"
                                   value="{{ old('designation', $employee->designation) }}"
                                   class="form-control rounded-3 @error('designation') is-invalid @enderror">
                            @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- SALARY -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Salary</label>
                            <input type="number" name="salary"
                                   value="{{ old('salary', $employee->salary) }}"
                                   class="form-control rounded-3 @error('salary') is-invalid @enderror">
                            @error('salary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- JOINING DATE -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Joining Date</label>
                            <input type="date" name="joining_date"
                                   value="{{ old('joining_date', $employee->joining_date) }}"
                                   class="form-control rounded-3 @error('joining_date') is-invalid @enderror">
                            @error('joining_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- STATUS -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select rounded-3">
                                <option value="1" {{ old('status', $employee->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $employee->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- ADDRESS -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" rows="4"
                                      class="form-control rounded-3">{{ old('address', $employee->address) }}</textarea>
                        </div>

                        <!-- PHOTO -->
                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-semibold">Employee Photo</label>

                            <input type="file" name="photo" id="photoInput"
                                   class="form-control rounded-3">

                            <div class="mt-3">
                                <img id="photoPreview"
                                     src="{{ $employee->photo ? asset('storage/'.$employee->photo) : 'https://via.placeholder.com/130' }}"
                                     class="rounded-circle border shadow"
                                     width="130"
                                     height="130"
                                     style="object-fit:cover;">
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-success rounded-3 px-4">

                                <i class="bi bi-check-circle me-1"></i>

                                Update Employee

                            </button>

                            <a href="{{ route('employees.index') }}" class="btn btn-light border rounded-3 px-4">
                                Cancel
                            </a>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('scripts')

    <script>
        document.getElementById('photoInput').addEventListener('change', function(e){
            const file = e.target.files[0];
            if(file){
                document.getElementById('photoPreview').src = URL.createObjectURL(file);
            }
        });
    </script>

@endpush
@push('scripts')

    <script>

    </script>

@endpush
