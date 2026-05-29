@extends('hr.layout.admin')

@section('content')

    <div class="card shadow border-0">

        <div class="card-header">

            <h4>Generate Salary</h4>

        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('hr.salary.store') }}">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Employee</label>

                        <select name="employee_id"
                                class="form-control">

                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Salary Month</label>

                        <input type="month"
                               name="salary_month"
                               class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>Basic Salary</label>

                        <input type="number"
                               name="basic_salary"
                               class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>Bonus</label>

                        <input type="number"
                               name="bonus"
                               class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label>Deduction</label>

                        <input type="number"
                               name="deduction"
                               class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Payment Status</label>

                        <select name="payment_status"
                                class="form-control">

                            <option value="Pending">
                                Pending
                            </option>

                            <option value="Paid">
                                Paid
                            </option>

                        </select>

                    </div>

                </div>

                <button class="btn btn-success">

                    Generate Salary

                </button>

            </form>

        </div>

    </div>

@endsection
