@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid">

        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header bg-white d-flex justify-content-between align-items-center">

                <h4 class="fw-bold mb-0">
                    Employee Details
                </h4>

                <a href="{{ route('hr.employees.index') }}"
                   class="btn btn-dark">

                    Back

                </a>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 text-center mb-4">

                        @if($employee->photo)

                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                 class="rounded-circle border border-4 border-white shadow"
                                 width="380"
                                 height="480"
                                 style="object-fit:cover;">

                        @else

                            <img src="https://via.placeholder.com/110"
                                 class="rounded-circle border border-4 border-white shadow">

                        @endif

                    </div>

                    <div class="col-md-8">

                        <table class="table table-bordered">

                            <tr>
                                <th>Name</th>
                                <td>{{ $employee->name }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>{{ $employee->email }}</td>
                            </tr>

                            <tr>
                                <th>Mobile</th>
                                <td>{{ $employee->mobile }}</td>
                            </tr>

                            <tr>
                                <th>Department</th>
                                <td>{{ $employee->department }}</td>
                            </tr>

                            <tr>
                                <th>Designation</th>
                                <td>{{ $employee->designation }}</td>
                            </tr>

                            <tr>
                                <th>Salary</th>
                                <td>₹{{ $employee->salary }}</td>
                            </tr>

                            <tr>
                                <th>Joining Date</th>
                                <td>{{ $employee->joining_date }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>

                                    @if($employee->status == 1)

                                        <span class="status-active">
                Active
            </span>

                                    @else

                                        <span class="status-pending">
                Inactive
            </span>

                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td>{{ $employee->address }}</td>
                            </tr>

                        </table>

                        <a href="{{ route('hr.employees.edit', $employee->id) }}"
                           class="btn btn-warning">

                            Edit Employee

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
