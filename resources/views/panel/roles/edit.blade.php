@extends('layouts.admin')

@section('page-title', 'Edit Role')

@section('content')

    <div class="container-fluid py-4">

        <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">
            <div class="card-body p-4 bg-primary text-white">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h2 class="fw-bold mb-1">Edit Role</h2>
                        <p class="mb-0 opacity-75">
                            Manage permissions for
                            <strong>{{ $role->name }}</strong>
                        </p>
                    </div>

                    <a href="{{ route('roles.index') }}"
                       class="btn btn-light rounded-pill px-4">
                        Back
                    </a>

                </div>

            </div>
        </div>

        <form action="{{ route('roles.update', $role->id) }}" method="POST" class="update-confirm">
            @csrf
            @method('PUT')

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">

                    <div class="row g-4">

                        <div class="col-md-8">
                            <label class="form-label fw-bold">Role Name</label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $role->name) }}"
                                   class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror">

                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Quick Actions</label>

                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="selectAll">

                                <label class="form-check-label fw-semibold">
                                    Select All Permissions
                                </label>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">

                @foreach($permissions as $groupName => $groupPermissions)

                    <div class="col-xl-4 col-lg-6 mb-4">

                        <div class="card border-0 shadow-sm rounded-4 permission-card h-100">

                            <div class="card-header bg-dark text-white rounded-top-4">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>
                                        <h6 class="mb-0 fw-bold">
                                            {{ ucwords(str_replace(['_', '.'], ' ', $groupName)) }}
                                        </h6>

                                        <small>
                                            {{ count($groupPermissions) }} Permissions
                                        </small>
                                    </div>

                                    <input type="checkbox"
                                           class="group-checkbox form-check-input">
                                </div>

                            </div>

                            <div class="card-body">

                                @foreach($groupPermissions as $permission)

                                    <div class="permission-item mb-2 p-3 border rounded-3">

                                        <div class="form-check">

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

            <div class="card border-0 shadow-lg rounded-4 sticky-bottom mt-4">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="mb-1 fw-bold">Save Changes</h5>
                            <small class="text-muted">
                                Permissions update instantly.
                            </small>
                        </div>

                        <div>
                            <a href="{{ route('roles.index') }}"
                               class="btn btn-light px-4 me-2">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-success px-5">
                                Update Role
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </form>

    </div>

    <style>
        .permission-card { transition: .3s; }
        .permission-card:hover { transform: translateY(-5px); }
        .permission-item { transition: .3s; }
        .permission-item:hover {
            background: #f8f9fa;
            border-color: #0d6efd !important;
        }
    </style>

    <script>
        document.getElementById('selectAll').addEventListener('change', function () {
            document.querySelectorAll('.permission-checkbox')
                .forEach(cb => cb.checked = this.checked);
        });

        document.querySelectorAll('.group-checkbox').forEach(group => {
            group.addEventListener('change', function () {
                let permissions = this.closest('.card')
                    .querySelectorAll('.permission-checkbox');

                permissions.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>

@endsection
