@extends('layouts.admin')

@section('page-title', 'Roles & Permissions')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold text-dark mb-1">
                    Roles & Permissions
                </h2>

                <p class="text-muted mb-0">
                    Manage system roles and assign permissions securely
                </p>
            </div>

            <a href="{{ route('roles.create') }}"
               class="btn btn-primary shadow rounded-3 px-4">
                <i class="bi bi-plus-circle me-2"></i>
                Add New Role
            </a>

        </div>

        <div class="row g-4 mb-4">

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-body p-4">
                        <p class="text-muted fw-semibold mb-2">Total Roles</p>
                        <h2 class="fw-bold mb-0">{{ $roles->count() }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-body p-4">
                        <p class="text-muted fw-semibold mb-2">Permissions</p>
                        <h2 class="fw-bold mb-0">
                            {{ \Spatie\Permission\Models\Permission::count() }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-body p-4">
                        <p class="text-muted fw-semibold mb-2">Active Users</p>
                        <h2 class="fw-bold mb-0">
                            {{ \App\Models\User::count() }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-body p-4">
                        <p class="text-muted fw-semibold mb-2">Security Status</p>
                        <h5 class="fw-bold text-success mb-0">Protected</h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="card-header bg-white border-0 p-4">
                <h4 class="fw-bold mb-1">Role Management</h4>
                <p class="text-muted mb-0">
                    Assign and manage role permissions across the CRM
                </p>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle table-hover mb-0">

                        <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3">Role Name</th>
                            <th class="py-3">Permissions</th>
                            <th class="py-3 text-center">Total</th>
                            <th class="py-3 text-center">Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($roles as $role)

                            <tr>
                                <td class="fw-semibold px-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                             style="width:45px;height:45px;">
                                            <i class="bi bi-person-badge-fill"></i>
                                        </div>

                                        <div>
                                            <h6 class="fw-bold mb-0 text-capitalize">
                                                {{ $role->name }}
                                            </h6>
                                            <small class="text-muted">System Access Role</small>
                                        </div>
                                    </div>
                                </td>

                                <td style="max-width:450px;">

                                    @if($role->permissions->count())

                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($role->permissions as $p)
                                                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2 fw-semibold">
                                                {{ $p->name }}
                                            </span>
                                            @endforeach
                                        </div>

                                    @else

                                        <span class="badge bg-light text-muted px-3 py-2 rounded-pill">
                                        No Permissions
                                    </span>

                                    @endif

                                </td>

                                <td class="text-center">
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                                    {{ $role->permissions->count() }}
                                </span>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="btn btn-warning btn-sm rounded-3 px-3 shadow-sm">
                                            <i class="bi bi-pencil-square me-1"></i>
                                            Assign
                                        </a>

                                        @if($role->name !== 'super-admin')
                                            <form action="{{ route('roles.destroy', $role->id) }}"
                                                  method="POST"
                                                  class="d-inline delete-confirm"
                                                 >
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm rounded-3 px-3 shadow-sm">
                                                    <i class="bi bi-trash-fill me-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    No Roles Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
