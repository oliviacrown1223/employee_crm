@extends('layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="mb-4">

            <h2 class="fw-bold">

                Account Settings

            </h2>

            <p class="text-muted">

                Manage profile & password

            </p>

        </div>

        <ul class="nav nav-tabs mb-4">

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


        <div class="tab-content">

            <!-- PROFILE -->

            <div class="tab-pane fade {{ session('active_tab') != 'password' ? 'show active' : '' }}"
                 id="profile">

                <div class="card border-0 shadow rounded-4">

                    <div class="card-body p-4">

                        <form action="{{ route('profile.update') }}"
                              method="POST">

                            @csrf

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="fw-semibold">

                                        Name

                                    </label>

                                    <input type="text"
                                           name="name"
                                           class="form-control rounded-3 @error('name') is-invalid @enderror"
                                           value="{{ old('name', auth()->user()->name) }}">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="fw-semibold">

                                        Email

                                    </label>

                                    <input type="email"
                                           name="email"
                                           class="form-control rounded-3 @error('email') is-invalid @enderror"
                                           value="{{ old('email', auth()->user()->email) }}">

                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                            </div>

                            <button class="btn btn-primary rounded-3">

                                <i class="bi bi-check-circle me-1"></i>

                                Update Profile

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- PASSWORD -->

            <div class="tab-pane fade {{ session('active_tab') == 'password' ? 'show active' : '' }}"
                 id="password">

                <div class="card border-0 shadow rounded-4">

                    <div class="card-body p-4">

                        <form id="passwordForm"
                              method="POST"
                              action="{{ route('password.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Current Password
                                </label>

                                <input type="password"
                                       name="current_password"
                                       class="form-control rounded-3 @error('current_password') is-invalid @enderror">

                                @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="text-danger small mt-1 error_current_password"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    New Password
                                </label>

                                <input type="password"
                                       name="new_password"
                                       class="form-control rounded-3 @error('new_password') is-invalid @enderror">

                                @error('new_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="text-danger small mt-1 error_new_password"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Confirm Password
                                </label>

                                <input type="password"
                                       name="new_password_confirmation"
                                       class="form-control rounded-3 @error('new_password_confirmation') is-invalid @enderror">

                                @error('new_password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="text-danger small mt-1 error_new_password_confirmation"></div>
                            </div>

                            <button type="submit"
                                    class="btn btn-dark rounded-3">
                                <i class="bi bi-key me-1"></i>
                                Update Password
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
