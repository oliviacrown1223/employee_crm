@extends('layouts.admin')

@section('page-title', 'Edit User')

@section('content')

    <div class="container-fluid py-4 user-form-page">

        <div class="user-form-hero edit-user-hero mb-4">

            <div>
            <span class="hero-badge">
                <i class="bi bi-pencil-square me-1"></i>
                Update Account
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Edit User
                </h2>

                <p class="mb-0 opacity-75">
                    Update user account information, password and assigned role.
                </p>
            </div>

            <a href="{{ route('users.index') }}"
               class="btn btn-light rounded-pill px-4 py-2 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger rounded-4 border-0 shadow-sm">
                <strong>Please fix following errors:</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="premium-form-card">

            <div class="premium-form-header">
                <div>
                    <h5 class="fw-bold mb-1">
                        User Information
                    </h5>

                    <small class="text-muted">
                        Editing account:
                        <strong>{{ $user->name }}</strong>
                    </small>
                </div>

                <div class="form-header-icon warning-icon">
                    <i class="bi bi-person-check"></i>
                </div>
            </div>

            <form action="{{ route('users.update', $user->id) }}"
                  method="POST"
                  class="update-confirm"
                  novalidate>

                @csrf
                @method('PUT')

                <div class="premium-form-body">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Full Name
                            </label>

                            <div class="input-icon-box">
                                <i class="bi bi-person"></i>

                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="form-control premium-input @error('name') is-invalid @enderror"
                                       placeholder="Enter full name"
                                       maxlength="50"
                                       oninput="this.value=this.value.replace(/[^A-Za-z ]/g,'')">
                            </div>

                            @error('name')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <div class="input-icon-box">
                                <i class="bi bi-envelope"></i>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="form-control premium-input @error('email') is-invalid @enderror"
                                       placeholder="example@email.com"
                                       maxlength="100">
                            </div>

                            @error('email')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                New Password
                            </label>

                            <div class="input-icon-box">
                                <i class="bi bi-lock"></i>

                                <input type="password"
                                       name="password"
                                       class="form-control premium-input @error('password') is-invalid @enderror"
                                       placeholder="Leave blank to keep old password"
                                       minlength="8">
                            </div>

                            <small class="text-muted d-block mt-1">
                                Leave blank if you don't want to change password.
                            </small>

                            @error('password')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Confirm New Password
                            </label>

                            <div class="input-icon-box">
                                <i class="bi bi-shield-lock"></i>

                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control premium-input"
                                       placeholder="Confirm new password"
                                       minlength="8">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Role
                            </label>

                            <div class="input-icon-box">
                                <i class="bi bi-person-badge"></i>

                                <select name="role"
                                        class="form-select premium-input @error('role') is-invalid @enderror">
                                    <option value="">Select Role</option>

                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('role')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Current Role
                            </label>

                            <div class="input-icon-box">
                                <i class="bi bi-shield-check"></i>

                                <input type="text"
                                       class="form-control premium-input"
                                       value="{{ ucwords(str_replace('-', ' ', $user->roles->first()?->name ?? 'No Role')) }}"
                                       readonly>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="premium-form-footer">

                    <a href="{{ route('users.index') }}"
                       class="btn btn-light border rounded-pill px-4">
                        Cancel
                    </a>

                    <button type="submit"
                            class="btn btn-warning rounded-pill px-5 fw-semibold text-dark">
                        <i class="bi bi-check-circle me-1"></i>
                        Update User
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
