@extends('layouts.admin')

@section('page-title', 'Edit Role')

@section('content')

    <div class="container-fluid py-4 role-form-page">

        <div class="role-form-hero edit-role-hero mb-4">

            <div>
            <span class="hero-badge">
                <i class="bi bi-shield-check me-1"></i>
                Update Security Role
            </span>

                <h2 class="fw-bold mt-3 mb-2">
                    Edit Role
                </h2>

                <p class="mb-0 opacity-75">
                    Manage permissions for
                    <strong>{{ $role->name }}</strong>
                </p>
            </div>

            <a href="{{ route('roles.index') }}"
               class="btn btn-light rounded-pill px-4 fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

        <form action="{{ route('roles.update', $role->id) }}"
              method="POST"
              class="update-confirm">

            @csrf
            @method('PUT')

            <div class="role-info-card mb-4">

                <div class="row g-4 align-items-center">

                    <div class="col-md-8">
                        <label class="form-label fw-bold">
                            Role Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $role->name) }}"
                               class="form-control form-control-lg role-input @error('name') is-invalid @enderror"
                               placeholder="Enter Role Name"
                               required>

                        @error('name')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">
                            Quick Actions
                        </label>

                        <div class="select-all-box">
                            <div>
                                <h6 class="mb-0 fw-bold">
                                    Select All Permissions
                                </h6>
                                <small class="text-muted">
                                    Enable or disable all permissions
                                </small>
                            </div>

                            <div class="form-check form-switch m-0 fs-5">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="selectAll">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row g-4">

                @foreach($permissions as $groupName => $groupPermissions)

                    <div class="col-xl-4 col-lg-6">

                        <div class="permission-card h-100">

                            <div class="permission-card-header">

                                <div>
                                    <h6 class="mb-1 fw-bold">
                                        {{ ucwords(str_replace(['_', '.'], ' ', $groupName)) }}
                                    </h6>

                                    <small>
                                        {{ count($groupPermissions) }} Permissions
                                    </small>
                                </div>

                                <input type="checkbox"
                                       class="group-checkbox form-check-input">
                            </div>

                            <div class="permission-card-body">

                                @foreach($groupPermissions as $permission)

                                    <div class="permission-item">

                                        <div class="form-check mb-0">

                                            <input class="form-check-input permission-checkbox"
                                                   type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->name }}"
                                                   id="perm_{{ $permission->id }}"
                                                {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>

                                            <label class="form-check-label fw-semibold"
                                                   for="perm_{{ $permission->id }}">
                                                {{ ucwords(str_replace(['.', '_'], ' ', $permission->name)) }}
                                            </label>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="role-submit-card mt-4">

                <div>
                    <h5 class="fw-bold mb-1">
                        Save Changes
                    </h5>

                    <small class="text-muted">
                        Permissions update instantly.
                    </small>
                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('roles.index') }}"
                       class="btn btn-light border rounded-pill px-4">
                        Cancel
                    </a>

                    <button type="submit"
                            class="btn btn-success rounded-pill px-5 fw-semibold">
                        <i class="bi bi-check-circle me-1"></i>
                        Update Role
                    </button>

                </div>

            </div>

        </form>

    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function () {
            document.querySelectorAll('.permission-checkbox')
                .forEach(cb => cb.checked = this.checked);
        });

        document.querySelectorAll('.group-checkbox').forEach(group => {
            group.addEventListener('change', function () {
                let permissions = this.closest('.permission-card')
                    .querySelectorAll('.permission-checkbox');

                permissions.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>

@endsection
