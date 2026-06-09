@extends('layouts.admin')

@section('page-title', 'Edit Salary')

@section('content')

    <div class="container-fluid py-4 salary-create-page salary-edit-page">

        <div class="salary-create-hero salary-edit-hero mb-4">

            <div>
            <span class="salary-create-badge">
                <i class="bi bi-pencil-square me-1"></i>
                Payroll Module
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Edit Employee Salary
                </h2>

                <p class="mb-0 opacity-75">
                    Update payroll information, bonuses & deductions
                </p>
            </div>

            <a href="{{ route('salary.index') }}"
               class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10">

                <div class="salary-create-card">

                    <div class="salary-create-card-header">
                        <div>
                            <h5 class="fw-bold mb-1">Salary Information</h5>
                            <small class="text-muted">Update employee monthly payroll</small>
                        </div>

                        <div class="salary-create-icon salary-edit-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>

                    <div class="salary-create-body">

                        <form action="{{ route('salary.update', $salary->id) }}"
                              method="POST"
                              id="salaryUpdateForm"
                              class="update-confirm">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Employee</label>

                                    <div class="salary-create-input-box">
                                        <i class="bi bi-person"></i>

                                        <select name="employee_id"
                                                id="employee_id"
                                                class="form-select salary-create-input">

                                            <option value="">Select Employee</option>

                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                        data-salary="{{ $employee->salary }}"
                                                    {{ old('employee_id', $salary->employee_id) == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Basic Salary</label>

                                    <div class="salary-create-input-box">
                                        <i class="bi bi-currency-rupee"></i>

                                        <input type="number"
                                               name="basic_salary"
                                               id="basic_salary"
                                               value="{{ old('basic_salary', $salary->basic_salary) }}"
                                               readonly
                                               class="form-control salary-create-input">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Bonus</label>

                                    <div class="salary-create-input-box">
                                        <i class="bi bi-plus-circle"></i>

                                        <input type="number"
                                               name="bonus"
                                               id="bonus"
                                               value="{{ old('bonus', $salary->bonus) }}"
                                               class="form-control salary-create-input">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Deduction</label>

                                    <div class="salary-create-input-box">
                                        <i class="bi bi-dash-circle"></i>

                                        <input type="number"
                                               name="deduction"
                                               id="deduction"
                                               value="{{ old('deduction', $salary->deduction) }}"
                                               class="form-control salary-create-input">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Salary Month</label>

                                    <div class="salary-create-input-box">
                                        <i class="bi bi-calendar-month"></i>

                                        <input type="month"
                                               name="salary_month"
                                               value="{{ old('salary_month', $salary->salary_month) }}"
                                               class="form-control salary-create-input">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Payment Status</label>

                                    <div class="salary-create-input-box">
                                        <i class="bi bi-credit-card"></i>

                                        <select name="payment_status"
                                                class="form-select salary-create-input">

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
                                </div>

                                <div class="col-12">
                                    <div class="net-salary-card salary-edit-preview">

                                        <div>
                                        <span class="net-salary-label">
                                            Net Salary
                                        </span>

                                            <h5 class="fw-bold mb-1">
                                                Auto calculated salary preview
                                            </h5>

                                            <small>
                                                Basic + Bonus - Deduction
                                            </small>
                                        </div>

                                        <div class="net-salary-amount">
                                            ₹ <span id="netSalaryPreview">0</span>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="salary-create-actions mt-5">

                                <a href="{{ route('salary.index') }}"
                                   class="btn btn-light border rounded-pill px-5 py-3">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-warning rounded-pill px-5 py-3 fw-bold text-dark">
                                    <i class="bi bi-check-circle me-1"></i>
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
        function calculateNetSalary() {
            let basic = parseFloat(document.getElementById('basic_salary').value) || 0;
            let bonus = parseFloat(document.getElementById('bonus').value) || 0;
            let deduction = parseFloat(document.getElementById('deduction').value) || 0;

            document.getElementById('netSalaryPreview').innerText =
                (basic + bonus - deduction).toFixed(2);
        }

        document.getElementById('employee_id').addEventListener('change', function () {
            let salary = this.options[this.selectedIndex].getAttribute('data-salary') || 0;
            document.getElementById('basic_salary').value = salary;
            calculateNetSalary();
        });

        document.getElementById('bonus').addEventListener('input', calculateNetSalary);
        document.getElementById('deduction').addEventListener('input', calculateNetSalary);

        calculateNetSalary();
    </script>

@endsection
