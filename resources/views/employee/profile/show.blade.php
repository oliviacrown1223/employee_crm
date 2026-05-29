@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">
                    Employee Profile
                </h2>

                <p class="text-muted mb-0">
                    Complete employee information details
                </p>

            </div>

            <a href="{{ url()->previous() }}"
               class="btn btn-dark rounded-3 px-4">

                <i class="bi bi-arrow-left"></i>

                Back

            </a>

        </div>


        <div class="row">

            <!-- LEFT PROFILE CARD -->
            <div class="col-lg-4 mb-4">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <!-- TOP BG -->
                    <div class="bg-dark"
                         style="height:120px;">
                    </div>

                    <div class="card-body text-center position-relative">

                        <!-- PROFILE IMAGE -->
                        <div style="margin-top:-70px;">

                            @if($employee->photo)

                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                     width="140"
                                     height="140"
                                     class="rounded-circle border border-4 border-white shadow"
                                     style="object-fit:cover;">

                            @else

                                <img src="https://via.placeholder.com/140"
                                     width="140"
                                     height="140"
                                     class="rounded-circle border border-4 border-white shadow">

                            @endif

                        </div>

                        <!-- NAME -->
                        <h3 class="fw-bold mt-3 mb-1">

                            {{ $employee->name }}

                        </h3>

                        <!-- DESIGNATION -->
                        <p class="text-muted mb-3">

                            {{ $employee->designation }}

                        </p>

                        <!-- STATUS -->
                        @if($employee->status == 1)

                            <span class="badge bg-success px-4 py-2 rounded-pill">

                            Active Employee

                        </span>

                        @else

                            <span class="badge bg-danger px-4 py-2 rounded-pill">

                            Inactive Employee

                        </span>

                        @endif

                        <hr>

                        <!-- QUICK INFO -->
                        <div class="text-start mt-4">

                            <div class="mb-3">

                                <small class="text-muted d-block">
                                    Department
                                </small>

                                <strong>
                                    {{ $employee->department }}
                                </strong>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted d-block">
                                    Salary
                                </small>

                                <strong>
                                    ₹{{ number_format($employee->salary) }}
                                </strong>

                            </div>

                            <div class="mb-3">

                                <small class="text-muted d-block">
                                    Phone
                                </small>

                                <strong>
                                    {{ $employee->phone ?? 'N/A' }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- RIGHT DETAILS -->
            <div class="col-lg-8">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">

                            Personal Information

                        </h4>

                        <div class="row">

                            <!-- NAME -->
                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Full Name
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->name }}

                                </div>

                            </div>

                            <!-- EMAIL -->
                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Email Address
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->email }}

                                </div>

                            </div>

                            <!-- PHONE -->
                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Phone Number
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->mobile ?? 'N/A' }}

                                </div>

                            </div>

                            <!-- DEPARTMENT -->
                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Department
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->department }}

                                </div>

                            </div>

                            <!-- DESIGNATION -->
                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Designation
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->designation }}

                                </div>

                            </div>

                            <!-- SALARY -->
                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Salary
                                </label>

                                <div class="fw-semibold fs-5 text-success">

                                    ₹{{ number_format($employee->salary) }}

                                </div>

                            </div>

                            <!-- STATUS -->
                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Employee Status
                                </label>

                                <div>

                                    @if($employee->status == 1)

                                        <span class="badge bg-success px-3 py-2">

                                        Active

                                    </span>

                                    @else

                                        <span class="badge bg-danger px-3 py-2">

                                        Inactive

                                    </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
