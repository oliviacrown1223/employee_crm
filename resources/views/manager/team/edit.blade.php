@extends('manager.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Edit Employee
                </h2>

                <p class="text-muted">
                    Update employee information
                </p>

            </div>

            <a href="{{ url()->previous() }}"
               class="btn btn-dark rounded-3 px-4">

                Back

            </a>

        </div>


        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-body p-4">

                <form action="{{ route('manager.team.update', $employee->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- IMAGE -->
                        <div class="col-md-12 text-center mb-4">

                            @if($employee->photo)

                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                     width="120"
                                     height="120"
                                     class="rounded-circle shadow"
                                     style="object-fit:cover;">

                            @else

                                <img src="https://via.placeholder.com/120"
                                     class="rounded-circle shadow">

                            @endif

                        </div>


                        <!-- NAME -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Full Name

                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $employee->name) }}"
                                   class="form-control rounded-3">

                        </div>


                        <!-- EMAIL -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Email Address

                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $employee->email) }}"
                                   class="form-control rounded-3">

                        </div>


                        <!-- PHONE -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Phone Number

                            </label>

                            <input type="text"
                                   name="mobile"
                                   value="{{ old('mobile', $employee->mobile) }}"
                                   class="form-control rounded-3">

                        </div>


                        <!-- DEPARTMENT -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Department

                            </label>

                            <input type="text"
                                   name="department"
                                   value="{{ old('department', $employee->department) }}"
                                   class="form-control rounded-3">

                        </div>


                        <!-- DESIGNATION -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Designation

                            </label>

                            <input type="text"
                                   name="designation"
                                   value="{{ old('designation', $employee->designation) }}"
                                   class="form-control rounded-3">

                        </div>


                        <!-- SALARY -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Salary

                            </label>

                            <input type="number"
                                   name="salary"
                                   value="{{ old('salary', $employee->salary) }}"
                                   class="form-control rounded-3">

                        </div>


                        <!-- STATUS -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Status

                            </label>

                            <select name="status"
                                    class="form-select rounded-3">

                                <option value="1"
                                    {{ $employee->status == 1 ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="0"
                                    {{ $employee->status == 0 ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>


                        <!-- PHOTO -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">

                                Change Photo

                            </label>

                            <input type="file"
                                   name="photo"
                                   class="form-control rounded-3">

                        </div>


                        <!-- BUTTON -->
                        <div class="col-md-12">

                            <button class="btn btn-dark px-5 rounded-3">

                                Update Employee

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
