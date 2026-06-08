@extends('layouts.admin')

@section('page-title', 'Employees')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <div>
                <h3 class="fw-bold mb-1">
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
                <p class="text-muted mb-0">
                    Role wise employee access and management
                </p>
            </div>

            <div class="d-flex gap-2">

                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('employee.create.all'))
                    <a href="{{ route('employees.create') }}"
                       class="btn btn-primary rounded-3">
                        <i class="bi bi-plus-circle me-1"></i>
                        Add Employee
                    </a>
                @endif

                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('employee.export.all'))
                    <a href="{{ route('employees.export') }}"
                       class="btn btn-success rounded-3">
                        <i class="bi bi-file-earmark-excel me-1"></i>
                        Export
                    </a>
                @endif

            </div>

        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle">
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

                        <tbody>

                        @forelse($employees as $employee)

                            <tr>
                                <td>
                                    @if($employee->photo)
                                        <img src="{{ asset('storage/' . $employee->photo) }}"
                                             width="45"
                                             height="45"
                                             class="rounded-circle"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
                                             style="width:45px;height:45px;">
                                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>

                                <td class="fw-semibold">
                                    {{ $employee->name }}
                                </td>

                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->mobile }}</td>
                                <td>{{ $employee->department ?? '-' }}</td>
                                <td>{{ $employee->designation ?? '-' }}</td>

                                @hasanyrole('super-admin|hr')
                                <td>₹{{ number_format($employee->salary ?? 0, 2) }}</td>
                                @endhasanyrole

                                <td>
                                    @if($employee->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($employee->status == 'inactive')
                                        <span class="badge bg-danger">Inactive</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    @if(auth()->user()->hasAnyRole(['super-admin'])
                                    || auth()->user()->can('employee.view.all')
                                    || auth()->user()->can('employee.view.team')
                                    || auth()->user()->can('employee.view.self'))
                                    <a href="{{ route('employees.show', $employee->id) }}"
                                       class="btn btn-sm btn-info text-white rounded-3">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @endif
                                        @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('employee.edit.all'))
                                                 <a href="{{ route('employees.edit', $employee->id) }}"
                                                 class="btn btn-sm btn-warning rounded-3">
                                                 <i class="bi bi-pencil-square"></i>
                                             </a>
                                        @endif

                                    @role('super-admin')
                                    <form action="{{ route('employees.destroy', $employee->id) }}"
                                          method="POST"
                                          class="d-inline delete-confirm"
                                          >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger  rounded-3">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endrole

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No employee found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>
                    </table>

                </div>

                <div class="mt-3">
                    {{ $employees->links() }}
                </div>

            </div>
        </div>

    </div>

@endsection
