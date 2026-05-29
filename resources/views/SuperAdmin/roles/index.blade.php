@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="fw-bold text-dark mb-1">

                    Roles & Permissions

                </h2>

                <p class="text-muted mb-0">

                    Manage system roles and assign permissions securely

                </p>

            </div>

            <div class="d-flex gap-2">



                <a href="{{ route('roles.create') }}"
                   class="btn btn-primary shadow rounded-3 px-4">

                    <i class="bi bi-plus-circle me-2"></i>

                    Add New Role

                </a>

            </div>

        </div>



        <!-- STATISTICS -->
        <div class="row g-4 mb-4">

            <!-- TOTAL ROLES -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-shield-lock-fill display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Total Roles

                                </p>

                                <h2 class="fw-bold mb-0">

                                    {{ $roles->count() }}

                                </h2>

                            </div>

                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-shield-lock-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- TOTAL PERMISSIONS -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-key-fill display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Permissions

                                </p>

                                <h2 class="fw-bold mb-0">

                                    {{ \Spatie\Permission\Models\Permission::count() }}

                                </h2>

                            </div>

                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-key-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- ACTIVE USERS -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-people-fill display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Active Users

                                </p>

                                <h2 class="fw-bold mb-0">

                                    {{ \App\Models\User::count() }}

                                </h2>

                            </div>

                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-people-fill fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- SYSTEM SECURITY -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">

                    <div class="card-body p-4 position-relative">

                        <div class="position-absolute top-0 end-0 opacity-10 pe-3 pt-2">

                            <i class="bi bi-shield-check display-1"></i>

                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <p class="text-muted fw-semibold mb-2">

                                    Security Status

                                </p>

                                <h5 class="fw-bold text-success mb-0">

                                    Protected

                                </h5>

                            </div>

                            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:70px;height:70px;">

                                <i class="bi bi-shield-check fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- CARD HEADER -->
            <div class="card-header bg-white border-0 p-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h4 class="fw-bold mb-1">

                            Role Management

                        </h4>

                        <p class="text-muted mb-0">

                            Assign and manage role permissions across the CRM

                        </p>

                    </div>

                    <!-- SEARCH -->
                    <div class="position-relative">

                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>

                        <input type="text"
                               class="form-control ps-5 rounded-3 shadow-sm border-0 bg-light"
                               placeholder="Search roles..."
                               style="width:250px;">

                    </div>

                </div>

            </div>



            <!-- TABLE -->
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

                                <!-- ID -->
                                <td class="fw-semibold px-4">

                                    {{ $loop->iteration }}

                                </td>



                                <!-- ROLE -->
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

                                            <small class="text-muted">

                                                System Access Role

                                            </small>

                                        </div>

                                    </div>

                                </td>



                                <!-- PERMISSIONS -->
                                <td style="max-width:450px;">

                                    @php

                                        // FILTER ROLE WISE PERMISSIONS
                                        if($role->name == 'employee') {

                                            $filteredPermissions = $role->permissions
                                                ->filter(function($p) {

                                                    return str_contains($p->name, '.self');

                                                });

                                        }

                                        elseif($role->name == 'manager') {

                                            $filteredPermissions = $role->permissions
                                                ->filter(function($p) {

                                                    return str_contains($p->name, '.team');

                                                });

                                        }

                                        elseif($role->name == 'hr') {

                                            $filteredPermissions = $role->permissions
                                                ->filter(function($p) {

                                                    return str_contains($p->name, '.all');

                                                });

                                        }

                                        // SUPER ADMIN
                                        else {

                                            $filteredPermissions = $role->permissions;

                                        }

                                    @endphp



                                    @if($filteredPermissions->count())

                                        <div class="d-flex flex-wrap gap-2">

                                            @foreach($filteredPermissions as $p)

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



                                <!-- TOTAL -->
                                <td class="text-center">

                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">

                                        {{ $role->permissions->count() }}

                                    </span>

                                </td>



                                <!-- ACTIONS -->
                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- EDIT -->
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="btn btn-warning btn-sm rounded-3 px-3 shadow-sm">

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Assign

                                        </a>



                                        <!-- DELETE -->
                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-3 px-3 shadow-sm"
                                                    onclick="return confirm('Are you sure you want to delete this role?')">

                                                <i class="bi bi-trash-fill me-1"></i>

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center py-5">

                                    <div class="d-flex flex-column align-items-center">

                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3"
                                             style="width:80px;height:80px;">

                                            <i class="bi bi-folder-x text-muted fs-1"></i>

                                        </div>

                                        <h5 class="fw-bold text-dark">

                                            No Roles Found

                                        </h5>

                                        <p class="text-muted mb-0">

                                            Create your first role to manage permissions.

                                        </p>

                                    </div>

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
