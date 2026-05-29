@extends('hr.layout.admin')

@section('content')

    <div class="card shadow border-0">

        <div class="card-header">

            <h4>Edit Salary</h4>

        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('hr.salary.update', $salary->id) }}">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Employee</label>

                        <select name="employee_id"
                                class="form-select">

                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}"
                                    {{ $salary->employee_id == $employee->id ? 'selected' : '' }}>

                                    {{ $employee->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Salary Month</label>

                        <input type="month"
                               name="salary_month"
                               value="{{ $salary->salary_month }}"
                               class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>Basic Salary</label>

                        <input type="number"
                               name="basic_salary"
                               value="{{ $salary->basic_salary }}"
                               class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>Bonus</label>

                        <input type="number"
                               name="bonus"
                               value="{{ $salary->bonus }}"
                               class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>Deduction</label>

                        <input type="number"
                               name="deduction"
                               value="{{ $salary->deduction }}"
                               class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Payment Status</label>

                        <select name="payment_status"
                                class="form-control">

                            <option value="Pending"
                                {{ $salary->payment_status == 'Pending' ? 'selected' : '' }}>

                                Pending

                            </option>

                            <option value="Paid"
                                {{ $salary->payment_status == 'Paid' ? 'selected' : '' }}>

                                Paid

                            </option>

                        </select>

                    </div>

                </div>

                <button class="btn btn-primary">

                    Update Salary

                </button>

            </form>

        </div>

    </div>

@endsection
