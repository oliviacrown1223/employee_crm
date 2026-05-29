@extends('SuperAdmin.layouts.admin')

@section('content')

    @php

        $groupedPermissions = $permissions->groupBy(function($permission) {

            return explode('-', $permission->name)[0];

        });

    @endphp



    @foreach($groupedPermissions as $module => $modulePermissions)

        <div class="card border-0 shadow-sm mb-3">

            <div class="card-header bg-light">

                <h6 class="mb-0 text-uppercase fw-bold">

                    {{ str_replace('-', ' ', $module) }} Module

                </h6>

            </div>

            <div class="card-body">

                <div class="row">

                    @foreach($modulePermissions as $permission)

                        <div class="col-md-3 mb-2">

                            <div class="form-check">

                                <input type="checkbox"
                                       name="permissions[]"
                                       value="{{ $permission->name }}"
                                       class="form-check-input"

                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                                <label class="form-check-label">

                                    {{ ucfirst(str_replace('-', ' ', $permission->name)) }}

                                </label>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @endforeach

@endsection
