@extends('layouts.admin')

@section('page-title', 'Employee Profile')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-1">Employee Profile</h3>
                <p class="text-muted mb-0">View employee details</p>
            </div>

            <a href="{{ route('employees.index') }}"
               class="btn btn-outline-dark rounded-3">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center">

                        @if($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                 width="120"
                                 height="120"
                                 class="rounded-circle border mb-3"
                                 style="object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                 style="width:120px;height:120px;font-size:42px;">
                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                            </div>
                        @endif

                        <h4 class="fw-bold mb-1">
                            {{ $employee->name }}
                        </h4>

                        <p class="text-muted mb-2">
                            {{ $employee->designation ?? 'Employee' }}
                        </p>

                        @if($employee->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @elseif($employee->status == 'inactive')
                            <span class="badge bg-danger">Inactive</span>
                        @else
                            <span class="badge bg-secondary">No Status</span>
                        @endif

                    </div>
                </div>

            </div>

            <div class="col-md-8">

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            Personal Information
                        </h5>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <small class="text-muted">Email</small>
                                    <div class="fw-semibold">{{ $employee->email }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <small class="text-muted">Mobile</small>
                                    <div class="fw-semibold">{{ $employee->mobile ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <small class="text-muted">Department</small>
                                    <div class="fw-semibold">{{ $employee->department ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <small class="text-muted">Designation</small>
                                    <div class="fw-semibold">{{ $employee->designation ?? '-' }}</div>
                                </div>
                            </div>

                            @hasanyrole('super-admin|hr')
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <small class="text-muted">Salary</small>
                                    <div class="fw-semibold">
                                        ₹{{ number_format($employee->salary ?? 0, 2) }}
                                    </div>
                                </div>
                            </div>
                            @endhasanyrole

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3">
                                    <small class="text-muted">Joining Date</small>
                                    <div class="fw-semibold">
                                        {{ $employee->joining_date ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="border rounded-3 p-3">
                                    <small class="text-muted">Address</small>
                                    <div class="fw-semibold">
                                        {{ $employee->address ?? '-' }}
                                    </div>
                                </div>
                            </div>

                        </div>

                        @hasanyrole('super-admin|hr')
                        <div class="mt-4">
                            <a href="{{ route('employees.edit', $employee->id) }}"
                               class="btn btn-warning rounded-3">
                                <i class="bi bi-pencil-square me-1"></i>
                                Edit Employee
                            </a>
                        </div>
                        @endhasanyrole

                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
