<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EMPLOYEE CRM</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-light">

<div class="container-fluid min-vh-100">

    <div class="row min-vh-100">

        {{-- LEFT SIDE --}}

        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center bg-dark text-white">

            <div class="px-5">

                <span class="badge bg-primary px-4 py-2 fs-6 mb-4 rounded-pill">
                    Employee CRM
                </span>

                <h1 class="display-3 fw-bold mb-4 lh-sm">
                    Smart Employee
                    <br>
                    Management System
                </h1>

                <p class="lead text-light opacity-75 mb-5">
                    Manage employees, attendance, payroll,
                    leave and performance professionally.
                </p>

                <div class="row g-4">

                    <div class="col-4">

                        <div class="card border-0 bg-white bg-opacity-10 text-center rounded-4">

                            <div class="card-body py-4">

                                <h2 class="fw-bold text-white">
                                    500+
                                </h2>

                                <p class="mb-0 text-light">
                                    Employees
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="card border-0 bg-white bg-opacity-10 text-center rounded-4">

                            <div class="card-body py-4">

                                <h2 class="fw-bold text-white">
                                    24/7
                                </h2>

                                <p class="mb-0 text-light">
                                    Management
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="card border-0 bg-white bg-opacity-10 text-center rounded-4">

                            <div class="card-body py-4">

                                <h2 class="fw-bold text-white">
                                    100%
                                </h2>

                                <p class="mb-0 text-light">
                                    Secure
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- RIGHT SIDE --}}

        <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">

            <div class="card border-0 shadow-lg rounded-5 p-4 p-lg-5 w-100"
                 style="max-width: 500px;">

                {{-- HEADER --}}

                <div class="text-center mb-5">

                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold mb-4"
                         style="width: 90px; height: 90px; font-size: 30px;">

                        CRM

                    </div>

                    <h2 class="fw-bold mb-2">
                        Welcome Back
                    </h2>

                    <p class="text-muted mb-0">
                        Employee Management Dashboard
                    </p>

                </div>

                {{-- BUTTONS --}}

                <div class="d-grid gap-4">

                    @auth

                        <a href="{{ url('/dashboard') }}"
                           class="btn btn-dark btn-lg rounded-4 py-3 fw-semibold shadow-sm">

                            Go To Dashboard

                        </a>

                    @else

                        <a href="{{ route('login') }}"
                           class="btn btn-dark btn-lg rounded-4 py-3 fw-semibold shadow-sm">

                            Login

                        </a>

                        @if (Route::has('register'))

                            <a href="{{ route('register') }}"
                               class="btn btn-outline-dark btn-lg rounded-4 py-3 fw-semibold">

                                Create Account

                            </a>

                        @endif

                    @endauth

                </div>

                {{-- FOOTER --}}

                <div class="text-center mt-5">

                    <p class="text-muted mb-0">
                        © 2026 Employee CRM System
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
