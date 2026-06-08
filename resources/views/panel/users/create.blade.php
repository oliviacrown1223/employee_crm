@extends('layouts.admin')

@section('page-title', 'Create User')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">Create User</h2>
                <p class="text-muted mb-0">
                    Create new HR, Manager or Employee account
                </p>
            </div>

            <a href="{{ route('users.index') }}"
               class="btn btn-secondary rounded-3">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow rounded-4">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">User Information</h5>
            </div>

            <div class="card-body">

                <form action="{{ route('users.store') }}"
                      method="POST"
                      class="create-confirm">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Full Name
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Confirm Password
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Role
                            </label>

                            <select name="role"
                                    class="form-select"
                                    required>

                                <option value="">Select Role</option>

                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <hr>

                    <div class="text-end">

                        <a href="{{ route('users.index') }}"
                           class="btn btn-light">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-success">
                            <i class="bi bi-check-circle"></i>
                            Create User
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
