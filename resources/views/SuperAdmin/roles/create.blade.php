@extends('SuperAdmin.layouts.admin')

@section('content')

    <div class="container py-4">

        <!-- PAGE HEADER -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">

                    Create Role

                </h3>

                <p class="text-muted mb-0">

                    Manage role permissions for your CRM system

                </p>

            </div>

            <a href="{{ route('roles.index') }}"
               class="btn btn-dark rounded-3 px-4">

                <i class="bi bi-arrow-left me-1"></i>

                Back

            </a>

        </div>


        <!-- CARD -->

        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">


                <!-- FORM -->

                <form method="POST"
                      action="{{ route('roles.store') }}">

                    @csrf


                    <!-- ROLE NAME -->

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Role Name

                        </label>

                        <input type="text"
                               name="role_name"
                               class="form-control rounded-3"
                               placeholder="Enter Role Name">

                    </div>



                    <!-- PERMISSION TABLE -->

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle">

                            <thead class="table-light text-center">

                            <tr>

                                <th width="20%">
                                    Module
                                </th>

                                <th>
                                    View
                                </th>

                                <th>
                                    Create
                                </th>

                                <th>
                                    Edit
                                </th>

                                <th>
                                    Manage
                                </th>

                            </tr>

                            </thead>

                            <tbody>

                            @php

                                $modules = [
                                    'employee',
                                    'attendance',
                                    'salary',
                                    'daily_work',
                                    'leave',
                                    'performance'
                                ];

                                $actions = [
                                    'view',
                                    'create',
                                    'edit',
                                    'manage'
                                ];

                            @endphp


                            @foreach($modules as $module)

                                <tr>

                                    <!-- MODULE NAME -->

                                    <td class="fw-semibold text-capitalize">

                                        {{ str_replace('_', ' ', $module) }}

                                    </td>


                                    <!-- ACTIONS -->

                                    @foreach($actions as $action)

                                        <td class="text-center">

                                            <div class="form-check d-flex justify-content-center">

                                                <input type="checkbox"
                                                       class="form-check-input shadow-none"
                                                       name="permissions[]"
                                                       value="{{ $module.'.'.$action.'.all' }}">

                                            </div>

                                        </td>

                                    @endforeach

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>


                    <!-- SUBMIT BUTTON -->

                    <div class="mt-4 text-end">

                        <button type="submit"
                                class="btn btn-primary rounded-3 px-5">

                            <i class="bi bi-check-circle me-1"></i>

                            Save Role

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
