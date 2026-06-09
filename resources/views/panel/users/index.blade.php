@extends('layouts.admin')

@section('page-title', 'User Management')

@section('content')

    <div class="container-fluid py-4 user-page">

        <div class="premium-hero mb-4">
            <div>
            <span class="hero-badge">
                <i class="bi bi-shield-check me-1"></i>
                Admin Control
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    User Management
                </h2>

                <p class="mb-0 opacity-75">
                    Manage HR, Manager and Employee accounts with role based access.
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="btn btn-light rounded-pill px-4 py-2 fw-semibold shadow-sm">
                <i class="bi bi-plus-circle me-1"></i>
                Add User
            </a>
        </div>

        <div class="row g-4 mb-4">

            <div class="col-xl-3 col-md-6">
                <div class="premium-stat stat-blue">
                    <div>
                        <p>Total Users</p>
                        <h3>{{ $users->total() }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="premium-stat stat-green">
                    <div>
                        <p>HR Users</p>
                        <h3>{{ \App\Models\User::role('hr')->count() }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="premium-stat stat-orange">
                    <div>
                        <p>Managers</p>
                        <h3>{{ \App\Models\User::role('manager')->count() }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="premium-stat stat-cyan">
                    <div>
                        <p>Employees</p>
                        <h3>{{ \App\Models\User::role('employee')->count() }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-person-workspace"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="premium-card">

            <div class="premium-card-header">
                <div>
                    <h5 class="fw-bold mb-1">User Directory</h5>
                    <small class="text-muted">All system users and their assigned roles</small>
                </div>

                <span class="total-pill">
                {{ $users->total() }} Users
            </span>
            </div>

            <div class="table-responsive">

                <table class="table premium-table align-middle mb-0">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        @php
                            $role = $user->getRoleNames()->first();
                            $initial = strtoupper(substr($user->name, 0, 1));
                        @endphp

                        <tr>
                            <td>
                            <span class="row-number">
                                {{ $loop->iteration }}
                            </span>
                            </td>

                            <td>
                                <div class="user-info">
                                    <div class="avatar-circle">
                                        {{ $initial }}
                                    </div>

                                    <div>
                                        <h6 class="mb-0 fw-bold">
                                            {{ $user->name }}
                                        </h6>
                                        <small class="text-muted">
                                            Active account
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <td>
                            <span class="email-text">
                                {{ $user->email }}
                            </span>
                            </td>

                            <td>
                                @if($role == 'super-admin')
                                    <span class="role-badge role-dark">Super Admin</span>
                                @elseif($role == 'hr')
                                    <span class="role-badge role-green">HR</span>
                                @elseif($role == 'manager')
                                    <span class="role-badge role-orange">Manager</span>
                                @elseif($role == 'employee')
                                    <span class="role-badge role-blue">Employee</span>
                                @else
                                    <span class="role-badge role-muted">No Role</span>
                                @endif
                            </td>

                            <td>
                            <span class="date-text">
                                {{ $user->created_at->format('d M Y') }}
                            </span>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    @if(!$user->hasRole('super-admin'))

                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="action-btn edit-btn">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST"
                                              class="d-inline delete-confirm">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action-btn delete-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    @else

                                        <span class="protected-pill">
                                        <i class="bi bi-lock-fill me-1"></i>
                                        Protected
                                    </span>

                                    @endif

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-box">
                                    <i class="bi bi-person-x"></i>
                                    <h5 class="fw-bold mt-3">No Users Found</h5>
                                    <p class="text-muted mb-0">Create your first user account.</p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="premium-footer">
                {{ $users->links() }}
            </div>

        </div>

    </div>


@endsection
