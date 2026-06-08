@extends('layouts.admin')

@section('page-title', 'User Management')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">User Management</h2>
                <p class="text-muted mb-0">
                    Manage HR, Manager and Employee Accounts
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="btn btn-primary rounded-3">
                <i class="bi bi-plus-circle me-1"></i>
                Add User
            </a>

        </div>

        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card border-0 shadow bg-primary text-white rounded-4">
                    <div class="card-body">
                        <h3 class="fw-bold">{{ $users->total() }}</h3>
                        <p class="mb-0">Total Users</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow bg-success text-white rounded-4">
                    <div class="card-body">
                        <h3 class="fw-bold">
                            {{ \App\Models\User::role('hr')->count() }}
                        </h3>
                        <p class="mb-0">HR Users</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow bg-warning text-dark rounded-4">
                    <div class="card-body">
                        <h3 class="fw-bold">
                            {{ \App\Models\User::role('manager')->count() }}
                        </h3>
                        <p class="mb-0">Managers</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow bg-info text-white rounded-4">
                    <div class="card-body">
                        <h3 class="fw-bold">
                            {{ \App\Models\User::role('employee')->count() }}
                        </h3>
                        <p class="mb-0">Employees</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="card border-0 shadow rounded-4">

            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">User List</h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th width="180">Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($users as $user)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td class="fw-semibold">
                                    {{ $user->name }}
                                </td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @php
                                        $role = $user->getRoleNames()->first();
                                    @endphp

                                    <span class="badge bg-primary">
                                    {{ ucfirst($role ?? 'No Role') }}
                                </span>
                                </td>

                                <td>
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                                <td>

                                    @if(!$user->hasRole('super-admin'))
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="btn btn-sm btn-warning rounded-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST"
                                              class="d-inline delete-confirm"
                                              >

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-3">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>
                                    @else
                                        <span class="badge bg-dark">
                                        Protected
                                    </span>
                                    @endif

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center text-muted py-4">
                                    No Users Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection
