@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- HEADER --}}
                    <div class="bg-dark text-white p-4 position-relative">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h3 class="fw-bold mb-1">
                                    Generate Employee Salary
                                </h3>

                                <p class="mb-0 opacity-75">
                                    Create monthly payroll with bonus & deduction management
                                </p>

                            </div>

                            <div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center shadow"
                                 style="width:70px;height:70px;font-size:28px;">

                                💰

                            </div>

                        </div>

                        {{-- Decorative Circle --}}
                        <div class="position-absolute top-0 end-0 translate-middle-y opacity-10"
                             style="width:220px;height:220px;background:#fff;border-radius:50%;">
                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-4 p-lg-5">

                        <form action="{{ route('superadmin.salaries.store') }}"
                              method="POST">

                            @csrf

                            <div class="row g-4">

                                {{-- EMPLOYEE --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Employee
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        👤
                                    </span>

                                        <select name="employee_id"
                                                id="employee_id"
                                                class="form-select border-0 bg-light rounded-end-4 py-3 @error('employee_id', 'salary') is-invalid @enderror">

                                            <option value="">
                                                Select Employee
                                            </option>

                                            @foreach($employees as $employee)

                                                <option value="{{ $employee->id }}"
                                                        data-salary="{{ $employee->salary }}"
                                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>

                                                    {{ $employee->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('employee_id', 'salary')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- MONTH --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Salary Month
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        📅
                                    </span>

                                        <input type="month"
                                               name="salary_month"
                                               value="{{ old('salary_month') }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('salary_month', 'salary') is-invalid @enderror">

                                    </div>

                                    @error('salary_month', 'salary')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- BASIC SALARY --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Basic Salary
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        ₹
                                    </span>

                                        <input type="number"
                                               name="basic_salary"
                                               id="basic_salary"
                                               value="{{ old('basic_salary') }}"
                                               readonly
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('basic_salary', 'salary') is-invalid @enderror">

                                    </div>

                                    @error('basic_salary', 'salary')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- BONUS --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Bonus
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        🎁
                                    </span>

                                        <input type="number"
                                               name="bonus"
                                               value="{{ old('bonus', 0) }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('bonus', 'salary') is-invalid @enderror">

                                    </div>

                                    @error('bonus', 'salary')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- DEDUCTION --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Deduction
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        ➖
                                    </span>

                                        <input type="number"
                                               name="deduction"
                                               value="{{ old('deduction', 0) }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('deduction', 'salary') is-invalid @enderror">

                                    </div>

                                    @error('deduction', 'salary')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- STATUS --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Payment Status
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        💳
                                    </span>

                                        <select name="payment_status"
                                                class="form-select border-0 bg-light rounded-end-4 py-3 @error('payment_status', 'salary') is-invalid @enderror">

                                            <option value="Pending"
                                                {{ old('payment_status') == 'Pending' ? 'selected' : '' }}>

                                                Pending

                                            </option>

                                            <option value="Paid"
                                                {{ old('payment_status') == 'Paid' ? 'selected' : '' }}>

                                                Paid

                                            </option>

                                        </select>

                                    </div>

                                    @error('payment_status', 'salary')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                            </div>

                            {{-- BUTTON --}}
                            <div class="mt-5 text-end">

                                <button type="submit"
                                        class="btn btn-dark px-5 py-3 rounded-pill shadow-sm fw-semibold">

                                    Generate Salary

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- AUTO SALARY FILL --}}
    <script>



    </script>

@endsection
