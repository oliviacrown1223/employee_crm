<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Super Admin Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-dark">

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center p-3">

    <div class="row w-100 justify-content-center">

        <div class="col-12 col-xl-10">

            {{-- MAIN GLASS CARD --}}
            <div class="card border-0 rounded-5 overflow-hidden shadow-lg bg-dark text-white">

                <div class="row g-0">

                    {{-- LEFT CONTENT --}}
                    <div class="col-lg-7 position-relative">

                        <div class="p-5 h-100 d-flex flex-column justify-content-between">

                            {{-- TOP --}}
                            <div>

                                <div class="d-flex align-items-center mb-5">

                                    <div class="bg-white text-dark rounded-4 fw-bold d-flex align-items-center justify-content-center"
                                         style="width:70px;height:70px;font-size:26px;">

                                        CRM

                                    </div>

                                    <div class="ms-3">

                                        <h4 class="fw-bold mb-0">

                                            EMPLOYEE CRM

                                        </h4>

                                        <small class="text-light opacity-75">

                                            Super Admin Panel

                                        </small>

                                    </div>

                                </div>

                                <h1 class="display-2 fw-bold lh-sm mb-4">

                                    Admin
                                    <br>
                                    Control
                                    <br>
                                    Center

                                </h1>

                                <p class="fs-5 text-light opacity-75 mb-5">

                                    Securely manage employees, HR operations,
                                    departments, payroll and complete system access
                                    from one powerful dashboard.

                                </p>

                            </div>



                            {{-- CENTER BOXES --}}
                            <div class="row g-4">

                                <div class="col-md-6">

                                    <div class="bg-white bg-opacity-10 rounded-5 p-4 h-100">

                                        <div class="fs-1 mb-3">

                                            🛡️

                                        </div>

                                        <h4 class="fw-bold">

                                            Full Control

                                        </h4>

                                        <p class="mb-0 text-light opacity-75">

                                            Manage complete CRM operations securely.

                                        </p>

                                    </div>

                                </div>



                                <div class="col-md-6">

                                    <div class="bg-white bg-opacity-10 rounded-5 p-4 h-100">

                                        <div class="fs-1 mb-3">

                                            ⚡

                                        </div>

                                        <h4 class="fw-bold">

                                            Advanced Access

                                        </h4>

                                        <p class="mb-0 text-light opacity-75">

                                            High-level authorization for administrators.

                                        </p>

                                    </div>

                                </div>

                            </div>



                            {{-- BOTTOM --}}
                            <div class="row text-center mt-5">

                                <div class="col-4">

                                    <h2 class="fw-bold">

                                        100%

                                    </h2>

                                    <p class="text-light opacity-75 mb-0">

                                        Secure

                                    </p>

                                </div>

                                <div class="col-4">

                                    <h2 class="fw-bold">

                                        24/7

                                    </h2>

                                    <p class="text-light opacity-75 mb-0">

                                        Monitoring

                                    </p>

                                </div>

                                <div class="col-4">

                                    <h2 class="fw-bold">

                                        Admin

                                    </h2>

                                    <p class="text-light opacity-75 mb-0">

                                        Access

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- RIGHT LOGIN --}}
                    <div class="col-lg-5 bg-white text-dark">

                        <div class="h-100 d-flex align-items-center">

                            <div class="w-100 p-4 p-lg-5">

                                {{-- MOBILE LOGO --}}
                                <div class="d-lg-none text-center mb-4">

                                    <div class="bg-dark text-white rounded-4 d-inline-flex align-items-center justify-content-center fw-bold"
                                         style="width:70px;height:70px;font-size:26px;">

                                        CRM

                                    </div>

                                </div>



                                <div class="mb-5">

                                    <span class="badge bg-dark px-3 py-2 rounded-pill mb-3">

                                        Super Admin Login

                                    </span>

                                    <h2 class="fw-bold mb-2">

                                        Welcome Back

                                    </h2>

                                    <p class="text-muted">

                                        Login to continue admin dashboard

                                    </p>

                                </div>



                                {{-- ERROR --}}
                                @if(session('error'))

                                    <div class="alert alert-danger border-0 rounded-4">

                                        {{ session('error') }}

                                    </div>

                                @endif



                                {{-- SUCCESS --}}
                                @if(session('success'))

                                    <div class="alert alert-success border-0 rounded-4">

                                        {{ session('success') }}

                                    </div>

                                @endif



                                {{-- FORM --}}
                                <form method="POST"
                                      action="{{ url('/admin/login') }}">

                                    @csrf



                                    {{-- EMAIL --}}
                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">

                                            Email Address

                                        </label>

                                        <input type="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               class="form-control form-control-lg rounded-4 border-2 @error('email') is-invalid @enderror"
                                               placeholder="Enter your email">

                                        @error('email')

                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>

                                        @enderror

                                    </div>



                                    {{-- PASSWORD --}}
                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">

                                            Password

                                        </label>

                                        <input type="password"
                                               name="password"
                                               class="form-control form-control-lg rounded-4 border-2 @error('password') is-invalid @enderror"
                                               placeholder="Enter your password">

                                        @error('password')

                                        <div class="invalid-feedback">

                                            {{ $message }}

                                        </div>

                                        @enderror

                                    </div>



                                    {{-- OPTIONS --}}
                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <div class="form-check">

                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="remember">

                                            <label class="form-check-label"
                                                   for="remember">

                                                Remember Me

                                            </label>

                                        </div>

                                    </div>



                                    {{-- BUTTON --}}
                                    <div class="d-grid mb-4">

                                        <button type="submit"
                                                class="btn btn-dark btn-lg rounded-4 py-3 fw-semibold">

                                            Access Admin Dashboard

                                        </button>

                                    </div>



                                    {{-- FOOTER --}}
                                    <div class="text-center">

                                        <small class="text-muted">

                                            © 2026 Employee CRM Platform

                                        </small>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
