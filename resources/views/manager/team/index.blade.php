@extends('manager.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">
                    Team Employees
                </h2>

                <p class="text-muted mb-0">
                    Manage and monitor all team members
                </p>

            </div>

            <div>

            <span class="badge bg-dark px-3 py-2 fs-6">

                Total :
                {{ $employees->total() }}

            </span>

            </div>

        </div>


        <!-- FILTER -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">

            <div class="card-body p-4">

                <form method="GET">

                    <div class="row g-3">

                        <!-- SEARCH -->
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Search
                            </label>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control rounded-3"
                                   placeholder="Search employee">

                        </div>

                        <!-- DEPARTMENT -->
                        <div class="col-md-3">

                            <label class="form-label fw-semibold">
                                Department
                            </label>

                            <select name="department"
                                    class="form-select rounded-3">

                                <option value="">
                                    All Departments
                                </option>

                                @foreach($departments as $d)

                                    <option value="{{ $d }}"
                                        {{ request('department') == $d ? 'selected' : '' }}>

                                        {{ $d }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- STATUS -->
                        <div class="col-md-3">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select name="status"
                                    class="form-select rounded-3">

                                <option value="">
                                    All Status
                                </option>

                                <option value="1"
                                    {{ request('status') == '1' ? 'selected' : '' }}>

                                    Active

                                </option>

                                <option value="0"
                                    {{ request('status') == '0' ? 'selected' : '' }}>

                                    Inactive

                                </option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <div class="col-md-2">

                            <label class="form-label">
                                &nbsp;
                            </label>

                            <button class="btn btn-dark w-100 rounded-3">

                                Filter

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        <!-- EMPLOYEE CARDS -->
        <div class="row">

            @forelse($employees as $employee)

                <div class="col-xl-4 col-lg-6 mb-4">

                    <div class="card border-0 shadow-lg rounded-4 h-100">

                        <!-- TOP BG -->
                        <div class="bg-dark rounded-top-4"
                             style="height:90px;">
                        </div>

                        <div class="card-body text-center position-relative">

                            <!-- IMAGE -->
                            <div style="margin-top:-60px;">

                                @if($employee->photo)

                                    <img src="{{ asset('storage/' . $employee->photo) }}"
                                         width="110"
                                         height="110"
                                         class="rounded-circle border border-4 border-white shadow"
                                         style="object-fit:cover;">

                                @else

                                    <img src="https://via.placeholder.com/110"
                                         class="rounded-circle border border-4 border-white shadow">

                                @endif

                            </div>

                            <!-- NAME -->
                            <h4 class="fw-bold mt-3 mb-1">

                                {{ $employee->name }}

                            </h4>

                            <!-- DESIGNATION -->
                            <p class="text-muted">

                                {{ $employee->designation }}

                            </p>

                            <!-- STATUS -->
                            @if($employee->status == 1)

                                <span class="badge bg-success px-3 py-2 rounded-pill">

                                Active

                            </span>

                            @else

                                <span class="badge bg-danger px-3 py-2 rounded-pill">

                                Inactive

                            </span>

                            @endif

                            <!-- INFO -->
                            <div class="mt-4 text-start">

                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Email
                                    </small>

                                    <strong>
                                        {{ $employee->email }}
                                    </strong>

                                </div>

                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Department
                                    </small>

                                    <strong>
                                        {{ $employee->department }}
                                    </strong>

                                </div>

                                <div class="mb-3">

                                    <small class="text-muted d-block">
                                        Salary
                                    </small>

                                    <strong>
                                        ₹{{ number_format($employee->salary) }}
                                    </strong>

                                </div>

                            </div>

                            <!-- BUTTON -->
                            <div class="mt-4">
                                @if(auth()->user()->can('employee.view.team'))
                                    <a href="{{ route('manager.team.show', $employee->id) }}"
                                       class="btn btn-dark w-100 rounded-3">

                                        View Full Profile

                                    </a>


                                @else

                                    <button class="btn btn-secondary btn-sm rounded-3" disabled>
                                        View Full Profile
                                    </button>

                                @endif


                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">

                    <div class="alert alert-danger rounded-4 text-center">

                        No Employees Found

                    </div>

                </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-center mt-4">

            {{ $employees->links() }}

        </div>

    </div>

@endsection
