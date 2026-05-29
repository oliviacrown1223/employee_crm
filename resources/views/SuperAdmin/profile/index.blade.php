@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="mb-4">

            <h2 class="fw-bold">
                Admin Settings
            </h2>

            <p class="text-muted">
                Manage your account settings
            </p>

        </div>




        <!-- TABS -->
        <ul class="nav nav-tabs mb-4">

            <li class="nav-item">

                <button class="nav-link active"
                        data-bs-toggle="tab"
                        data-bs-target="#profile">

                    <i class="bi bi-person me-2"></i>

                    Admin Profile

                </button>

            </li>

            <li class="nav-item">

                <button class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#password">

                    <i class="bi bi-key me-2"></i>

                    Update Password

                </button>

            </li>

        </ul>


        <!-- TAB CONTENT -->
        <div class="tab-content">

            <!-- PROFILE TAB -->
            <div class="tab-pane fade show active"
                 id="profile">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <form method="POST"
                              action="{{ route('admin.profile.update') }}">

                            @csrf

                            <div class="row">

                                <!-- NAME -->
                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Full Name
                                    </label>

                                    <input type="text"
                                           name="name"
                                           class="form-control rounded-3"
                                           value="{{ Auth::user()->name }}">

                                </div>

                                <!-- EMAIL -->
                                <div class="col-md-6 mb-3">

                                    <label class="form-label fw-semibold">
                                        Email Address
                                    </label>

                                    <input type="email"
                                           name="email"
                                           class="form-control rounded-3"
                                           value="{{ Auth::user()->email }}">

                                </div>

                            </div>

                            <button type="submit"
                                    class="btn btn-primary rounded-3 px-4">

                                <i class="bi bi-check-circle me-1"></i>

                                Update Profile

                            </button>

                        </form>

                    </div>

                </div>

            </div>


            <!-- PASSWORD TAB -->
            <div class="tab-pane fade"
                 id="password">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <form id="passwordForm"
                              method="POST"
                              action="{{ route('admin.password.update') }}">

                            @csrf

                            <!-- CURRENT PASSWORD -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Current Password <span class="text-danger">*</span>
                                </label>

                                <input type="password"
                                       name="current_password"
                                       id="current_password"
                                       class="form-control rounded-3"
                                       placeholder="Required">

                                <div class="text-danger small mt-1 error_current_password"></div>

                            </div>

                            <!-- NEW PASSWORD -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    New Password <span class="text-danger">*</span>
                                </label>

                                <input type="password"
                                       name="new_password"
                                       id="new_password"
                                       class="form-control rounded-3"
                                       placeholder="Required minimum 6 characters">

                                <div class="text-danger small mt-1 error_new_password"></div>

                            </div>

                            <!-- CONFIRM PASSWORD -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Confirm Password <span class="text-danger">*</span>
                                </label>

                                <input type="password"
                                       name="new_password_confirmation"
                                       id="new_password_confirmation"
                                       class="form-control rounded-3"
                                       placeholder="Required confirm password">

                                <div class="text-danger small mt-1 error_new_password_confirmation"></div>

                            </div>

                            <button type="submit"
                                    class="btn btn-dark rounded-3 px-4">

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
@push('scripts')

    <script>



    </script>

@endpush
