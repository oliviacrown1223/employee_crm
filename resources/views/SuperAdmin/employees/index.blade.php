@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="row g-4 mb-5">

        <!-- TOTAL EMPLOYEES -->
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2 fw-semibold">
                                Total Employees
                            </p>

                            <h2 class="fw-bold mb-0 text-dark">
                                {{ $employees->total() }}
                            </h2>

                        </div>

                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-people-fill text-primary fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- PRESENT TODAY -->
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2 fw-semibold">
                                Present Today
                            </p>

                            <h2 class="fw-bold mb-0 text-success">
                                {{ $presentToday }}
                            </h2>

                        </div>

                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-check-circle-fill text-success fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- PENDING TASKS -->
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2 fw-semibold">
                                Pending Tasks
                            </p>

                            <h2 class="fw-bold mb-0 text-warning">
                                {{ $pendingTasks }}
                            </h2>

                        </div>

                        <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-list-task text-warning fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- SALARY -->
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow rounded-4 overflow-hidden h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2 fw-semibold">
                                Total Paid Salary
                            </p>

                            <h4 class="fw-bold mb-0 text-danger">
                                ₹ {{ number_format($totalSalary) }}
                            </h4>

                        </div>

                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-cash-stack text-danger fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="table-section">


        <!-- TOP AREA -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4>Employee Management</h4>

                <p class="text-muted">

                    Manage all employee records

                </p>

            </div>


            <div>

                <a href="{{ route('employees.create') }}"
                   class="btn btn-primary">

                    <i class="bi bi-plus-circle"></i>

                    Add Employee

                </a>

            </div>

        </div>



        <form method="GET"
              action="{{ route('employees.index') }}">

            <div class="row mb-3">

                <div class="col-md-4">

                    <input type="text"
                           id="search"
                           class="form-control"
                           placeholder="Search Employee...">

                </div>



                <div class="col-md-2">

                    <a href="{{ route('employees.export') }}"
                       class="btn btn-success w-100">

                        <i class="bi bi-file-earmark-excel"></i>

                        Export

                    </a>

                </div>

            </div>

        </form>



        <!-- TABLE -->

        <table class="table table-hover align-middle">

            <thead>

            <tr>

                <th>ID</th>

                <th>Photo</th>

                <th>Name</th>

                <th>Email</th>

                <th>Department</th>

                <th>Joining Date</th>

                <th>Salary</th>

                <th>Address</th>

                <th>Status</th>

                <th width="180">Actions</th>

            </tr>

            </thead>


            <tbody id="employeeTable">

            @foreach($employees as $employee)

                <tr>

                    <td>EMP00{{ $employee->id }}</td>

                    <td>
                        @if($employee->photo)

                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                 class="rounded-circle border border-4 border-white shadow"
                                 width="80"
                                 height="80"
                                 style="object-fit:cover;">

                        @else

                            <img src="https://via.placeholder.com/110"
                                 class="rounded-circle border border-4 border-white shadow">

                        @endif
                    </td>

                    <td><strong>{{ $employee->name }}</strong></td>

                    <td>{{ $employee->email }}</td>

                    <td>{{ $employee->department }}</td>

                    <td>{{ $employee->joining_date }}</td>

                    <td>₹ {{ number_format($employee->salary) }}</td>

                    <td>{{ $employee->address }}</td>

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

                    <td>

                        <a href="{{ route('employees.show', $employee->id) }}"
                           class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>

                        <a href="{{ route('employees.edit', $employee->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}"
                              method="POST"
                              class="delete-form"
                              style="display:inline-block;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>



        <!-- PAGINATION -->

        <div class="d-flex justify-content-end">

            {{ $employees->links() }}

        </div>


    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

    $(document).ready(function(){

        $('#search').on('keyup', function(){

            let search = $(this).val();

            $.ajax({

                url: "{{ route('employees.index') }}",

                type: "GET",

                data: {
                    search: search
                },

                success:function(data){

                    $('#employeeTable').html($(data).find('#employeeTable').html());

                }

            });

        });

    });

</script>
