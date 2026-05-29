@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-4">

            <div>

                <div class="d-inline-flex align-items-center px-3 py-2 rounded-pill mb-3"
                     style="
                    background: rgba(79,70,229,0.1);
                    color:#4f46e5;
                    font-weight:600;
                 ">

                    <i class="bi bi-person-badge-fill me-2"></i>

                    Employee Profile

                </div>

                <h2 class="fw-bold mb-2"
                    style="font-size:42px;">

                    {{ $employee->name }}

                </h2>

                <p class="text-muted fs-5 mb-0">

                    Complete employee information and profile overview

                </p>

            </div>



            <!-- ACTION BUTTONS -->
            <div class="d-flex gap-3">

                <a href="{{ route('employees.edit', $employee->id) }}"
                   class="btn text-white px-4 py-3 rounded-4 shadow"
                   style="
                    background: linear-gradient(135deg,#f59e0b,#f97316);
                    border:none;
                    font-weight:600;
               ">

                    <i class="bi bi-pencil-square me-2"></i>

                    Edit Profile

                </a>



                <a href="{{ route('employees.index') }}"
                   class="btn btn-dark px-4 py-3 rounded-4 shadow fw-semibold">

                    <i class="bi bi-arrow-left-circle me-2"></i>

                    Back

                </a>

            </div>

        </div>



        <!-- PROFILE CARD -->
        <div class="row g-4">

            <!-- LEFT PROFILE -->
            <div class="col-lg-4">

                <div class="bg-white rounded-5 shadow-lg overflow-hidden h-100">

                    <!-- TOP BG -->
                    <div style="
                        height:140px;
                        background: linear-gradient(135deg,#4f46e5,#7c3aed);
                     ">
                    </div>



                    <!-- PROFILE -->
                    <div class="text-center px-4 pb-5"
                         style="margin-top:-70px;">

                        @if($employee->photo)

                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                 class="rounded-circle border border-5 border-white shadow"
                                 width="140"
                                 height="140"
                                 style="object-fit:cover;">

                        @else

                            <img src="https://via.placeholder.com/140"
                                 class="rounded-circle border border-5 border-white shadow">

                        @endif



                        <h3 class="fw-bold mt-4 mb-1">

                            {{ $employee->name }}

                        </h3>

                        <p class="text-muted mb-4">

                            {{ $employee->designation }}

                        </p>



                        @if($employee->status == 1)

                            <span class="badge rounded-pill px-4 py-3"
                                  style="
                                background:rgba(16,185,129,0.15);
                                color:#059669;
                                font-size:14px;
                              ">

                            <i class="bi bi-check-circle-fill me-1"></i>

                            Active Employee

                        </span>

                        @else

                            <span class="badge rounded-pill px-4 py-3"
                                  style="
                                background:rgba(239,68,68,0.15);
                                color:#dc2626;
                                font-size:14px;
                              ">

                            <i class="bi bi-x-circle-fill me-1"></i>

                            Inactive Employee

                        </span>

                        @endif

                    </div>

                </div>

            </div>



            <!-- RIGHT DETAILS -->
            <div class="col-lg-8">

                <div class="bg-white rounded-5 shadow-lg p-4 p-lg-5 h-100">

                    <div class="row g-4">

                        <!-- EMAIL -->
                        <div class="col-md-6">

                            <div class="border rounded-5 p-4 h-100">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="rounded-4 d-flex align-items-center justify-content-center me-3"
                                         style="
                                        width:60px;
                                        height:60px;
                                        background:#eff6ff;
                                        color:#2563eb;
                                        font-size:24px;
                                     ">

                                        <i class="bi bi-envelope-fill"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">

                                            Email Address

                                        </small>

                                        <h6 class="fw-bold mb-0">

                                            {{ $employee->email }}

                                        </h6>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- MOBILE -->
                        <div class="col-md-6">

                            <div class="border rounded-5 p-4 h-100">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="rounded-4 d-flex align-items-center justify-content-center me-3"
                                         style="
                                        width:60px;
                                        height:60px;
                                        background:#ecfdf5;
                                        color:#059669;
                                        font-size:24px;
                                     ">

                                        <i class="bi bi-telephone-fill"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">

                                            Mobile Number

                                        </small>

                                        <h6 class="fw-bold mb-0">

                                            {{ $employee->mobile }}

                                        </h6>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- DEPARTMENT -->
                        <div class="col-md-6">

                            <div class="border rounded-5 p-4 h-100">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="rounded-4 d-flex align-items-center justify-content-center me-3"
                                         style="
                                        width:60px;
                                        height:60px;
                                        background:#fef3c7;
                                        color:#d97706;
                                        font-size:24px;
                                     ">

                                        <i class="bi bi-building-fill"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">

                                            Department

                                        </small>

                                        <h6 class="fw-bold mb-0">

                                            {{ $employee->department }}

                                        </h6>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- SALARY -->
                        <div class="col-md-6">

                            <div class="border rounded-5 p-4 h-100">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="rounded-4 d-flex align-items-center justify-content-center me-3"
                                         style="
                                        width:60px;
                                        height:60px;
                                        background:#fee2e2;
                                        color:#dc2626;
                                        font-size:24px;
                                     ">

                                        <i class="bi bi-cash-stack"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">

                                            Salary

                                        </small>

                                        <h5 class="fw-bold text-success mb-0">

                                            ₹ {{ number_format($employee->salary) }}

                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- JOINING DATE -->
                        <div class="col-md-6">

                            <div class="border rounded-5 p-4 h-100">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="rounded-4 d-flex align-items-center justify-content-center me-3"
                                         style="
                                        width:60px;
                                        height:60px;
                                        background:#ede9fe;
                                        color:#7c3aed;
                                        font-size:24px;
                                     ">

                                        <i class="bi bi-calendar-check-fill"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">

                                            Joining Date

                                        </small>

                                        <h6 class="fw-bold mb-0">

                                            {{ \Carbon\Carbon::parse($employee->joining_date)->format('d M Y') }}

                                        </h6>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- STATUS -->
                        <div class="col-md-6">

                            <div class="border rounded-5 p-4 h-100">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="rounded-4 d-flex align-items-center justify-content-center me-3"
                                         style="
                                        width:60px;
                                        height:60px;
                                        background:#f3f4f6;
                                        color:#111827;
                                        font-size:24px;
                                     ">

                                        <i class="bi bi-shield-check"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">

                                            Current Status

                                        </small>

                                        <h6 class="fw-bold mb-0">

                                            {{ $employee->status == 1 ? 'Active' : 'Inactive' }}

                                        </h6>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- ADDRESS -->
                        <div class="col-12">

                            <div class="border rounded-5 p-4">

                                <div class="d-flex align-items-center mb-3">

                                    <div class="rounded-4 d-flex align-items-center justify-content-center me-3"
                                         style="
                                        width:60px;
                                        height:60px;
                                        background:#f1f5f9;
                                        color:#334155;
                                        font-size:24px;
                                     ">

                                        <i class="bi bi-geo-alt-fill"></i>

                                    </div>

                                    <div>

                                        <small class="text-muted d-block">

                                            Address

                                        </small>

                                        <h6 class="fw-bold mb-0">

                                            Employee Address

                                        </h6>

                                    </div>

                                </div>

                                <p class="text-muted mb-0 fs-6">

                                    {{ $employee->address }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
