@extends('employee.layout.admin')

@section('content')

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Apply Leave</h4>
        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('employee.leave.store') }}">

                @csrf
                <select name="employee_id"
                        class="form-control">

                    <option value="">Select Employee</option>

                    @foreach($employees as $employee)

                        <option value="{{ $employee->id }}">

                            {{ $employee->name }}

                        </option>

                    @endforeach

                </select>


                <div class="mb-3">

                    <label>Leave Type</label>

                    <select name="leave_type"
                            class="form-control">

                        <option>Sick Leave</option>
                        <option>Casual Leave</option>
                        <option>Emergency Leave</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Date</label>

                    <input type="date"
                           name="leave_date"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Reason</label>

                    <textarea name="reason"
                              class="form-control"></textarea>

                </div>

                <button class="btn btn-primary">

                    Submit

                </button>

            </form>

        </div>

    </div>

@endsection
