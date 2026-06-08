@extends('layouts.admin')

@section('page-title', 'Edit Salary')

@section('content')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    <div class="bg-warning bg-gradient p-4">
                        <h3 class="fw-bold text-dark mb-1">Edit Employee Salary</h3>
                        <p class="text-dark mb-0 opacity-75">
                            Update payroll information, bonuses & deductions
                        </p>
                    </div>

                    <div class="card-body p-4 p-lg-5">

                        <form action="{{ route('salary.update', $salary->id) }}"
                              method="POST"
                              id="salaryUpdateForm"
                              class="update-confirm">

                            @csrf
                            @method('PUT')

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Employee</label>

                                    <select name="employee_id"
                                            id="employee_id"
                                            class="form-select py-3">

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

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Basic Salary</label>

                                    <input type="number"
                                           name="basic_salary"
                                           id="basic_salary"
                                           value="{{ old('basic_salary', $salary->basic_salary) }}"
                                           readonly
                                           class="form-control py-3">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Bonus</label>

                                    <input type="number"
                                           name="bonus"
                                           id="bonus"
                                           value="{{ old('bonus', $salary->bonus) }}"
                                           class="form-control py-3">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Deduction</label>

                                    <input type="number"
                                           name="deduction"
                                           id="deduction"
                                           value="{{ old('deduction', $salary->deduction) }}"
                                           class="form-control py-3">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Salary Month</label>

                                    <input type="month"
                                           name="salary_month"
                                           value="{{ old('salary_month', $salary->salary_month) }}"
                                           class="form-control py-3">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Payment Status</label>

                                    <select name="payment_status"
                                            class="form-select py-3">

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

                                <div class="col-12">
                                    <div class="bg-light rounded-4 p-4 border">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="fw-bold mb-1">Net Salary</h5>
                                                <small class="text-muted">Auto calculated salary preview</small>
                                            </div>

                                            <h2 class="fw-bold text-success mb-0">
                                                ₹ <span id="netSalaryPreview">0</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-5 d-flex justify-content-end gap-3">

                                <a href="{{ route('salary.index') }}"
                                   class="btn btn-light border px-4 py-3 rounded-pill">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-warning px-5 py-3 rounded-pill fw-bold">
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
