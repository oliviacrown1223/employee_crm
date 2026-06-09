@extends('layouts.admin')

@section('page-title', 'Employees')

@section('content')

    <div class="container-fluid py-4 employee-page">

        <div class="employee-hero mb-4">

            <div>
            <span class="employee-hero-badge">
                <i class="bi bi-people-fill me-1"></i>
                Employee Directory
            </span>

                <h3 class="fw-bold mt-3 mb-2">
                    @if(auth()->user()->hasRole('super-admin'))
                        Employee Management
                    @elseif(auth()->user()->hasRole('manager'))
                        Team Employee
                    @elseif(auth()->user()->hasRole('hr'))
                        Employee Record
                    @else
                        My Profile
                    @endif
                </h3>

                <p class="mb-0 opacity-75">
                    Role wise employee access and management
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap">

                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('employee.create.all'))
                    <a href="{{ route('employees.create') }}"
                       class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i>
                        Add Employee
                    </a>
                @endif

                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('employee.export.all'))
                    <a href="{{ route('employees.export') }}"
                       class="btn btn-success rounded-pill px-4 fw-semibold shadow-sm">
                        <i class="bi bi-file-earmark-excel me-1"></i>
                        Export
                    </a>
                @endif

            </div>

        </div>

        <div class="employee-card">

            <div class="employee-card-header">

                <div>
                    <h5 class="fw-bold mb-1">
                        Employee List
                    </h5>
                    <small class="text-muted">
                        Search, view and manage employee records
                    </small>
                </div>

                <span class="employee-count-pill">
                {{ $employees->total() ?? $employees->count() }} Records
            </span>

            </div>

            <div class="employee-search-box">

                <div class="input-group employee-search-input">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>

                    <input type="text"
                           id="employeeLiveSearch"
                           class="form-control"
                           placeholder="Search employee name, email, mobile, department, designation, status...">
                </div>

            </div>

            <div class="table-responsive">

                <table class="table employee-table align-middle mb-0">

                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Department</th>
                        <th>Designation</th>

                        @hasanyrole('super-admin|hr')
                        <th>Salary</th>
                        @endhasanyrole

                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                    </thead>

                    <tbody id="employeeTableBody">

                    @forelse($employees as $employee)

                        <tr class="employee-row"
                            data-search="{{ strtolower($employee->name.' '.$employee->email.' '.$employee->mobile.' '.$employee->department.' '.$employee->designation.' '.$employee->status.' '.$employee->salary) }}">

                            <td>
                                @if($employee->photo)
                                    <img src="{{ asset('storage/' . $employee->photo) }}"
                                         class="employee-avatar-img">
                                @else
                                    <div class="employee-avatar-text">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div>
                                    <h6 class="fw-bold mb-0">
                                        {{ $employee->name }}
                                    </h6>
                                    <small class="text-muted">
                                        Employee Profile
                                    </small>
                                </div>
                            </td>

                            <td>
                            <span class="employee-muted-text">
                                {{ $employee->email }}
                            </span>
                            </td>

                            <td>
                            <span class="employee-muted-text">
                                {{ $employee->mobile }}
                            </span>
                            </td>

                            <td>
                            <span class="employee-soft-pill">
                                {{ $employee->department ?? '-' }}
                            </span>
                            </td>

                            <td>
                            <span class="employee-soft-pill">
                                {{ $employee->designation ?? '-' }}
                            </span>
                            </td>

                            @hasanyrole('super-admin|hr')
                            <td>
                            <span class="salary-pill">
                                ₹{{ number_format($employee->salary ?? 0, 2) }}
                            </span>
                            </td>
                            @endhasanyrole

                            <td>
                                @if($employee->status == 'active')
                                    <span class="status-pill status-active">Active</span>
                                @elseif($employee->status == 'inactive')
                                    <span class="status-pill status-inactive">Inactive</span>
                                @else
                                    <span class="status-pill status-empty">-</span>
                                @endif
                            </td>

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-2">

                                    @if(auth()->user()->hasAnyRole(['super-admin'])
                                    || auth()->user()->can('employee.view.all')
                                    || auth()->user()->can('employee.view.team')
                                    || auth()->user()->can('employee.view.self'))

                                        <a href="{{ route('employees.show', $employee->id) }}"
                                           class="employee-action-btn view-btn">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                    @endif

                                    @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('employee.edit.all'))

                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                           class="employee-action-btn edit-btn">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                    @endif

                                    @role('super-admin')

                                    <form action="{{ route('employees.destroy', $employee->id) }}"
                                          method="POST"
                                          class="d-inline delete-confirm">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="employee-action-btn delete-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                    @endrole

                                </div>

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="bi bi-person-x fs-1 d-block mb-2"></i>
                                No employee found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="employee-footer">
                {{ $employees->links() }}
            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('employeeLiveSearch');
            const rows = document.querySelectorAll('.employee-row');

            searchInput.addEventListener('input', function () {

                let value = this.value.toLowerCase().trim();

                rows.forEach(function (row) {
                    let text = row.getAttribute('data-search');

                    if (text.includes(value)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

            });

        });
    </script>

@endsection
