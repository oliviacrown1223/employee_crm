@extends('layouts.admin')

@section('page-title', 'Employee Profile')

@section('content')

    <div class="container-fluid py-4 employee-profile-page">

        <div class="employee-profile-hero mb-4">

            <div>
            <span class="employee-profile-badge">
                <i class="bi bi-person-vcard-fill me-1"></i>
                Employee Profile
            </span>

                <h3 class="fw-bold mt-3 mb-2">
                    {{ $employee->name }}
                </h3>

                <p class="mb-0 opacity-75">
                    View employee details and personal information
                </p>
            </div>

            <a href="{{ route('employees.index') }}"
               class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <div class="row g-4">

            <div class="col-lg-4">

                <div class="profile-main-card">

                    <div class="profile-cover"></div>

                    <div class="profile-content text-center">

                        @if($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                 class="profile-photo">
                        @else
                            <div class="profile-initial">
                                {{ strtoupper(substr($employee->name, 0, 1)) }}
                            </div>
                        @endif

                        <h4 class="fw-bold mb-1 mt-3">
                            {{ $employee->name }}
                        </h4>

                        <p class="text-muted mb-3">
                            {{ $employee->designation ?? 'Employee' }}
                        </p>

                        @if($employee->status == 'active')
                            <span class="profile-status status-active">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Active
                        </span>
                        @elseif($employee->status == 'inactive')
                            <span class="profile-status status-inactive">
                            <i class="bi bi-x-circle-fill me-1"></i>
                            Inactive
                        </span>
                        @else
                            <span class="profile-status status-empty">
                            No Status
                        </span>
                        @endif

                        <div class="profile-mini-info mt-4">

                            <div>
                                <i class="bi bi-building"></i>
                                <span>{{ $employee->department ?? '-' }}</span>
                            </div>

                            <div>
                                <i class="bi bi-phone"></i>
                                <span>{{ $employee->mobile ?? '-' }}</span>
                            </div>

                            <div>
                                <i class="bi bi-envelope"></i>
                                <span>{{ $employee->email }}</span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-8">

                <div class="profile-details-card">

                    <div class="profile-card-header">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Personal Information
                            </h5>

                            <small class="text-muted">
                                Employee complete profile details
                            </small>
                        </div>

                        @hasanyrole('super-admin|hr')
                        <a href="{{ route('employees.edit', $employee->id) }}"
                           class="btn btn-warning rounded-pill px-4 fw-semibold">
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit Employee
                        </a>
                        @endhasanyrole

                    </div>

                    <div class="profile-info-grid">

                        <div class="profile-info-box">
                            <div class="info-icon blue">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <small>Email</small>
                                <h6>{{ $employee->email }}</h6>
                            </div>
                        </div>

                        <div class="profile-info-box">
                            <div class="info-icon green">
                                <i class="bi bi-phone"></i>
                            </div>
                            <div>
                                <small>Mobile</small>
                                <h6>{{ $employee->mobile ?? '-' }}</h6>
                            </div>
                        </div>

                        <div class="profile-info-box">
                            <div class="info-icon purple">
                                <i class="bi bi-building"></i>
                            </div>
                            <div>
                                <small>Department</small>
                                <h6>{{ $employee->department ?? '-' }}</h6>
                            </div>
                        </div>

                        <div class="profile-info-box">
                            <div class="info-icon orange">
                                <i class="bi bi-person-workspace"></i>
                            </div>
                            <div>
                                <small>Designation</small>
                                <h6>{{ $employee->designation ?? '-' }}</h6>
                            </div>
                        </div>

                        @hasanyrole('super-admin|hr')
                        <div class="profile-info-box">
                            <div class="info-icon money">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div>
                                <small>Salary</small>
                                <h6>₹{{ number_format($employee->salary ?? 0, 2) }}</h6>
                            </div>
                        </div>
                        @endhasanyrole

                        <div class="profile-info-box">
                            <div class="info-icon cyan">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div>
                                <small>Joining Date</small>
                                <h6>{{ $employee->joining_date ?? '-' }}</h6>
                            </div>
                        </div>

                        <div class="profile-info-box full">
                            <div class="info-icon dark">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <small>Address</small>
                                <h6>{{ $employee->address ?? '-' }}</h6>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
