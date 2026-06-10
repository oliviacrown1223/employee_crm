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
                    <span class="row-number">{{ $loop->iteration }}</span>
                </td>

                <td>
                    <div class="user-info">
                        <div class="avatar-circle">
                            {{ $initial }}
                        </div>

                        <div>
                            <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                            <small class="text-muted">Active account</small>
                        </div>
                    </div>
                </td>

                <td>
                    <span class="email-text">{{ $user->email }}</span>
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

                                <button type="submit" class="action-btn delete-btn">
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
                        <p class="text-muted mb-0">No matching users found.</p>
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
