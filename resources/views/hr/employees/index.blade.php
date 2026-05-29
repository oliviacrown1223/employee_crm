@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="fw-bold mb-1">

                    Employee Management

                </h2>

                <p class="text-muted mb-0">

                    Manage all employee records, departments & payroll access

                </p>

            </div>

            <div class="d-flex gap-2 flex-wrap">

                <!-- EXPORT -->
                <a href="{{ route('hr.employees.export') }}"
                   class="btn btn-success rounded-3 shadow-sm">

                    <i class="bi bi-download me-2"></i>

                    Export CSV

                </a>

                <!-- ADD EMPLOYEE -->
                @if(auth()->user()->can('employee.create.all'))

                    <a href="{{ route('hr.employees.create') }}"
                       class="btn btn-primary rounded-3 shadow-sm px-4">

                        <i class="bi bi-plus-circle me-2"></i>

                        Add Employee

                    </a>

                @else

                    <button class="btn btn-secondary rounded-3 shadow-sm px-4"
                            disabled>

                        <i class="bi bi-lock-fill me-2"></i>

                        Add Employee

                    </button>

                @endif

            </div>

        </div>



        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- CARD TOP -->
            <div class="card-header bg-white border-0 p-4">

                <div class="row align-items-center g-3">

                    <!-- TITLE -->
                    <div class="col-md-4">

                        <h4 class="fw-bold mb-1">

                            Employees List

                        </h4>

                        <p class="text-muted small mb-0">

                            Total Employees:
                            {{ $employees->total() }}

                        </p>

                    </div>

                    <!-- SEARCH -->


                </div>

            </div>



            <!-- TABLE -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle table-hover mb-0">

                        <thead class="table-light">

                        <tr>

                            <th class="py-3 px-4">#</th>

                            <th class="py-3">Employee</th>

                            <th class="py-3">Contact</th>

                            <th class="py-3">Department</th>

                            <th class="py-3">Designation</th>

                            <th class="py-3">Salary</th>

                            <th class="py-3">Status</th>

                            <th class="py-3 text-center" width="220">

                                Actions

                            </th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($employees as $employee)

                            <tr>

                                <!-- ID -->
                                <td class="fw-semibold px-4">

                                    #{{ $employee->id }}

                                </td>



                                <!-- EMPLOYEE -->
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <!-- PHOTO -->
                                        <div>

                                            @if($employee->photo)

                                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                                     class="rounded-circle border border-3 border-white shadow"
                                                     width="70"
                                                     height="70"
                                                     style="object-fit:cover;">

                                            @else

                                                <img src="https://via.placeholder.com/70"
                                                     class="rounded-circle border border-3 border-white shadow">

                                            @endif

                                        </div>

                                        <!-- INFO -->
                                        <div>

                                            <h6 class="fw-bold mb-1">

                                                {{ $employee->name }}

                                            </h6>

                                            <small class="text-muted">

                                                Employee ID :
                                                EMP-{{ $employee->id }}

                                            </small>

                                        </div>

                                    </div>

                                </td>



                                <!-- CONTACT -->
                                <td>

                                    <div class="d-flex flex-column">

                                        <span class="fw-semibold">

                                            {{ $employee->email }}

                                        </span>

                                        <small class="text-muted">

                                            Company Mail

                                        </small>

                                    </div>

                                </td>



                                <!-- DEPARTMENT -->
                                <td>

                                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">

                                        {{ $employee->department }}

                                    </span>

                                </td>



                                <!-- DESIGNATION -->
                                <td>

                                    <span class="fw-semibold text-dark">

                                        {{ $employee->designation }}

                                    </span>

                                </td>



                                <!-- SALARY -->
                                <td>

                                    <span class="fw-bold text-success">

                                        ₹{{ number_format($employee->salary) }}

                                    </span>

                                </td>



                                <!-- STATUS -->
                                <td>

                                    @if($employee->status == 1)

                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">

                                            <i class="bi bi-check-circle-fill me-1"></i>

                                            Active

                                        </span>

                                    @else

                                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold">

                                            <i class="bi bi-x-circle-fill me-1"></i>

                                            Inactive

                                        </span>

                                    @endif

                                </td>



                                <!-- ACTIONS -->
                                <td>

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        <!-- VIEW -->
                                        @if(auth()->user()->can('employee.view.all'))

                                            <a href="{{ route('hr.employees.show', $employee->id) }}"
                                               class="btn btn-info btn-sm rounded-3 shadow-sm">

                                                <i class="bi bi-eye-fill"></i>

                                            </a>

                                        @else

                                            <button class="btn btn-secondary btn-sm rounded-3 shadow-sm"
                                                    disabled>

                                                <i class="bi bi-eye-fill"></i>

                                            </button>

                                        @endif



                                        <!-- EDIT -->
                                        @if(auth()->user()->can('employee.edit.all'))

                                            <a href="{{ route('hr.employees.edit', $employee->id) }}"
                                               class="btn btn-warning btn-sm rounded-3 shadow-sm">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                        @else

                                            <button class="btn btn-secondary btn-sm rounded-3 shadow-sm"
                                                    disabled>

                                                <i class="bi bi-pencil-square"></i>

                                            </button>

                                        @endif



                                        <!-- DELETE -->
                                        <form action="{{ route('hr.employees.destroy', $employee->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-3 shadow-sm"
                                                    onclick="return confirm('Are you sure you want to delete this employee?')">

                                                <i class="bi bi-trash-fill"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center py-5">

                                    <div class="d-flex flex-column align-items-center">

                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                             style="width:90px;height:90px;">

                                            <i class="bi bi-people-fill text-muted fs-1"></i>

                                        </div>

                                        <h4 class="fw-bold text-dark">

                                            No Employees Found

                                        </h4>

                                        <p class="text-muted mb-0">

                                            Employee records will appear here.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>



            <!-- PAGINATION -->
            <div class="card-footer bg-white border-0 py-3">

                {{ $employees->links() }}

            </div>

        </div>

    </div>

@endsection
