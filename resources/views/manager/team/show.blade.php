@extends('manager.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Employee Profile
                </h2>

                <p class="text-muted">
                    Full employee details
                </p>

            </div>

            <div class="d-flex gap-2">

                <a href="{{ url()->previous() }}"
                   class="btn btn-dark rounded-3 px-4">

                    Back

                </a>

                <a href="{{ route('manager.team.edit', $employee->id) }}"
                   class="btn btn-primary rounded-3 px-4">

                    Edit Employee

                </a>

            </div>

        </div>


        <div class="row">

            <!-- PROFILE -->
            <div class="col-lg-4 mb-4">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="bg-dark"
                         style="height:120px;">
                    </div>

                    <div class="card-body text-center position-relative">

                        <div style="margin-top:-70px;">

                            @if($employee->photo)

                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                     width="140"
                                     height="140"
                                     class="rounded-circle border border-4 border-white shadow"
                                     style="object-fit:cover;">

                            @else

                                <img src="https://via.placeholder.com/140"
                                     class="rounded-circle border border-4 border-white shadow">

                            @endif

                        </div>

                        <h3 class="fw-bold mt-3">

                            {{ $employee->name }}

                        </h3>

                        <p class="text-muted">

                            {{ $employee->designation }}

                        </p>

                    </div>

                </div>

            </div>


            <!-- DETAILS -->
            <div class="col-lg-8">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Full Name
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->name }}

                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Email Address
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->email }}

                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Phone Number
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->mobile ?? 'N/A' }}

                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Department
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->department }}

                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Designation
                                </label>

                                <div class="fw-semibold fs-5">

                                    {{ $employee->designation }}

                                </div>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="text-muted small">
                                    Salary
                                </label>

                                <div class="fw-semibold fs-5 text-success">

                                    ₹{{ number_format($employee->salary) }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
