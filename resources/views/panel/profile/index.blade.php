@extends('layouts.admin')

@section('content')

    <div class="container-fluid py-4 profile-page">

        <div class="profile-hero mb-4">

            <div>
            <span class="profile-badge">
                <i class="bi bi-gear-fill me-1"></i>
                Account Settings
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Account Settings
                </h2>

                <p class="mb-0 opacity-75">
                    Manage profile & password
                </p>
            </div>

            <div class="profile-hero-icon">
                <i class="bi bi-person-gear"></i>
            </div>

        </div>

        <div class="profile-tabs-card mb-4">

            <ul class="nav nav-pills profile-tabs">

                <li class="nav-item">

                    <button class="nav-link {{ session('active_tab') != 'password' ? 'active' : '' }}"
                            data-bs-toggle="tab"
                            data-bs-target="#profile"
                            type="button">
                        <i class="bi bi-person me-2"></i>
                        Profile
                    </button>

                </li>

                <li class="nav-item">

                    <button class="nav-link {{ session('active_tab') == 'password' ? 'active' : '' }}"
                            data-bs-toggle="tab"
                            data-bs-target="#password"
                            type="button">
                        <i class="bi bi-key me-2"></i>
                        Password
                    </button>

                </li>

            </ul>

        </div>

        <div class="tab-content">

            {{-- PROFILE --}}
            <div class="tab-pane fade {{ session('active_tab') != 'password' ? 'show active' : '' }}"
                 id="profile">

                <div class="profile-card">

                    <div class="profile-card-header">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Profile Information
                            </h5>

                            <small class="text-muted">
                                Update your account profile details
                            </small>
                        </div>

                        <div class="profile-card-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        <form action="{{ route('profile.update') }}"
                              method="POST">

                            @csrf

                            <div class="row g-4">

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Name
                                    </label>

                                    <div class="profile-input-box">
                                        <i class="bi bi-person"></i>

                                        <input type="text"
                                               name="name"
                                               class="form-control profile-input @error('name') is-invalid @enderror"
                                               value="{{ old('name', auth()->user()->name) }}">
                                    </div>

                                    @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Email
                                    </label>

                                    <div class="profile-input-box">
                                        <i class="bi bi-envelope"></i>

                                        <input type="email"
                                               name="email"
                                               class="form-control profile-input @error('email') is-invalid @enderror"
                                               value="{{ old('email', auth()->user()->email) }}">
                                    </div>

                                    @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                            </div>

                            <div class="profile-actions mt-5">

                                <button class="btn btn-primary rounded-pill px-5 py-3 fw-semibold">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Update Profile
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            {{-- PASSWORD --}}
            <div class="tab-pane fade {{ session('active_tab') == 'password' ? 'show active' : '' }}"
                 id="password">

                <div class="profile-card">

                    <div class="profile-card-header">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Password Security
                            </h5>

                            <small class="text-muted">
                                Change your account password safely
                            </small>
                        </div>

                        <div class="profile-card-icon dark-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        <form id="passwordForm"
                              method="POST"
                              action="{{ route('password.update') }}">
                            @csrf

                            <div class="row g-4">

                                <div class="col-md-12">

                                    <label class="form-label fw-semibold">
                                        Current Password
                                    </label>

                                    <div class="profile-input-box">
                                        <i class="bi bi-lock"></i>

                                        <input type="password"
                                               name="current_password"
                                               class="form-control profile-input @error('current_password') is-invalid @enderror">
                                    </div>

                                    @error('current_password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <div class="text-danger small mt-1 error_current_password"></div>

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        New Password
                                    </label>

                                    <div class="profile-input-box">
                                        <i class="bi bi-key"></i>

                                        <input type="password"
                                               name="new_password"
                                               class="form-control profile-input @error('new_password') is-invalid @enderror">
                                    </div>

                                    @error('new_password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <div class="text-danger small mt-1 error_new_password"></div>

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Confirm Password
                                    </label>

                                    <div class="profile-input-box">
                                        <i class="bi bi-shield-check"></i>

                                        <input type="password"
                                               name="new_password_confirmation"
                                               class="form-control profile-input @error('new_password_confirmation') is-invalid @enderror">
                                    </div>

                                    @error('new_password_confirmation')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <div class="text-danger small mt-1 error_new_password_confirmation"></div>

                                </div>

                            </div>

                            <div class="profile-actions mt-5">

                                <button type="submit"
                                        class="btn btn-dark rounded-pill px-5 py-3 fw-semibold">
                                    <i class="bi bi-key me-1"></i>
                                    Update Password
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
