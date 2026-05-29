@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container">

        <h3 class="mb-4">
            Manage Permissions :
            <span class="text-primary">{{ $role->name }}</span>
        </h3>

        <form action="{{ route('roles.update', $role->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                @foreach($permissions as $module => $modulePermissions)

                    <div class="col-md-6 mb-4">

                        <div class="card shadow-sm border-0">

                            <div class="card-header bg-dark text-white">

                                <strong>
                                    {{ strtoupper(str_replace('_',' ',$module)) }}
                                </strong>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    @foreach($modulePermissions as $permission)

                                        <div class="col-md-6 mb-3">

                                            <div class="border rounded p-2">

                                                <label class="fw-bold">

                                                    <input type="checkbox"
                                                           name="permissions[]"
                                                           value="{{ $permission->name }}"

                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                                    {{ $permission->name }}

                                                </label>

                                                <br>

                                                @php

                                                    $parts = explode('.', $permission->name);

                                                    $scope = end($parts);

                                                @endphp

                                                @if($scope == 'self')

                                                    <span class="badge bg-success">
        Employee
    </span>

                                                @elseif($scope == 'team')

                                                    <span class="badge bg-warning text-dark">
        Manager
    </span>

                                                @elseif($scope == 'all')

                                                    <span class="badge bg-danger">
        HR
    </span>

                                                @else

                                                    <span class="badge bg-secondary">
        General
    </span>

                                                @endif

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <button class="btn btn-success px-5">
                Update Permissions
            </button>

        </form>

    </div>

@endsection
