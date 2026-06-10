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

                <div class="d-flex align-items-center gap-3">
                    <input type="text"
                           id="userSearch"
                           class="form-control rounded-pill"
                           placeholder="Search user name or email..."
                           style="width: 280px;">

                    <span class="total-pill">
                      {{ $users->total() }} Users
                   </span>
                </div>
             </div>
            <div id="userTableData">
                @include('panel.users.partials.user-table')
            </div>

        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('userSearch');
            const tableData = document.getElementById('userTableData');

            searchInput.addEventListener('keyup', function () {

                let search = this.value;

                fetch("{{ route('users.search') }}?search=" + encodeURIComponent(search), {
                    method: "GET",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                    .then(response => response.text())
                    .then(data => {
                        tableData.innerHTML = data;
                    })
                    .catch(error => {
                        console.log(error);
                    });

            });

        });
    </script>
@endsection


