@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- HEADER --}}
                    <div class="bg-warning bg-gradient p-4 position-relative">

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>

                                <h3 class="fw-bold text-dark mb-1">
                                    Edit Employee Salary
                                </h3>

                                <p class="text-dark mb-0 opacity-75">
                                    Update payroll information, bonuses & deductions
                                </p>

                            </div>

                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                 style="width:70px;height:70px;font-size:30px;">

                                ✏️

                            </div>

                        </div>

                        {{-- Decorative Circle --}}
                        <div class="position-absolute top-0 end-0 translate-middle-y opacity-10"
                             style="width:220px;height:220px;background:#fff;border-radius:50%;">
                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-4 p-lg-5">

                        <form action="{{ route('superadmin.salaries.update', $salary->id) }}"
                              method="POST"
                              id="UpdateForm">

                            @csrf
                            @method('PUT')

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
                                                class="form-select border-0 bg-light rounded-end-4 py-3 @error('employee_id') is-invalid @enderror">

                                            <option value="">
                                                Select Employee
                                            </option>

                                            @foreach($employees as $employee)

                                                <option value="{{ $employee->id }}"
                                                        data-salary="{{ $employee->salary }}"
                                                    {{ old('employee_id', $salary->employee_id) == $employee->id ? 'selected' : '' }}>

                                                    {{ $employee->name }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    @error('employee_id')

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
                                               value="{{ old('basic_salary', $salary->basic_salary) }}"
                                               readonly
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('basic_salary') is-invalid @enderror">

                                    </div>

                                    @error('basic_salary')

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
                                               id="bonus"
                                               value="{{ old('bonus', $salary->bonus) }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('bonus') is-invalid @enderror">

                                    </div>

                                    @error('bonus')

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
                                               id="deduction"
                                               value="{{ old('deduction', $salary->deduction) }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('deduction') is-invalid @enderror">

                                    </div>

                                    @error('deduction')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- SALARY MONTH --}}
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
                                               value="{{ old('salary_month', $salary->salary_month) }}"
                                               class="form-control border-0 bg-light rounded-end-4 py-3 @error('salary_month') is-invalid @enderror">

                                    </div>

                                    @error('salary_month')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- PAYMENT STATUS --}}
                                <div class="col-md-6">

                                    <label class="form-label fw-semibold text-dark mb-2">
                                        Payment Status
                                    </label>

                                    <div class="input-group">

                                    <span class="input-group-text bg-light border-0 rounded-start-4">
                                        💳
                                    </span>

                                        <select name="payment_status"
                                                class="form-select border-0 bg-light rounded-end-4 py-3 @error('payment_status') is-invalid @enderror">

                                            <option value="Pending"
                                                {{ old('payment_status', $salary->payment_status) == 'Pending' ? 'selected' : '' }}>

                                                Pending

                                            </option>

                                            <option value="Paid"
                                                {{ old('payment_status', $salary->payment_status) == 'Paid' ? 'selected' : '' }}>

                                                Paid

                                            </option>

                                        </select>

                                    </div>

                                    @error('payment_status')

                                    <div class="text-danger small mt-2 fw-semibold">
                                        {{ $message }}
                                    </div>

                                    @enderror

                                </div>

                                {{-- LIVE NET SALARY --}}
                                <div class="col-12">

                                    <div class="bg-light rounded-4 p-4 border">

                                        <div class="d-flex justify-content-between align-items-center">

                                            <div>

                                                <h5 class="fw-bold mb-1">
                                                    Net Salary
                                                </h5>

                                                <small class="text-muted">
                                                    Auto calculated salary preview
                                                </small>

                                            </div>

                                            <div>

                                                <h2 class="fw-bold text-success mb-0">

                                                    ₹ <span id="netSalaryPreview">0</span>

                                                </h2>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- BUTTONS --}}
                            <div class="mt-5 d-flex justify-content-end gap-3">

                                <a href="{{ route('superadmin.salaries.index') }}"
                                   class="btn btn-light border px-4 py-3 rounded-pill fw-semibold">

                                    Cancel

                                </a>

                                <button type="submit"
                                        class="btn btn-warning px-5 py-3 rounded-pill fw-bold shadow-sm">

                                    Update Salary

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>



    </script>

@endsection
