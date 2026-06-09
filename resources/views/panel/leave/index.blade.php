@extends('layouts.admin')

@section('page-title', 'Leave Management')

@section('content')

    <div class="container-fluid py-4">

        <div class="leave-header mb-4">

            <div>

        <span class="leave-module-badge">
            <i class="bi bi-calendar2-check me-1"></i>
            Leave Module
        </span>

                <h2 class="fw-bold mt-3 mb-1">
                    @if(auth()->user()->hasRole('employee'))
                        My Leave
                    @else
                        Leave Management
                    @endif
                </h2>

                <p class="text-muted mb-0">
                    Manage employee leave requests and approvals
                </p>

            </div>

            <div class="d-flex gap-2 flex-wrap align-items-center">

                <div class="leave-counter-card">
                    <small>Total Leaves</small>
                    <h4 class="mb-0 fw-bold">
                        {{ $leaves->count() }}
                    </h4>
                </div>

                @can('leave.apply.self')
                    @hasanyrole('employee')

                    <a href="{{ route('leave.create') }}"
                       class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i>
                        Apply Leave
                    </a>

                    @endhasanyrole
                @endcan

            </div>

        </div>



        <div class="leave-main-card">

            <div class="leave-card-header">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <h5 class="text-white fw-semibold mb-1">
                            Leave Requests
                        </h5>

                        <small class="text-light opacity-75">
                            Employee leave approval system
                        </small>
                    </div>

                    <div class="position-relative">

                        <input type="text"
                               id="leaveSearch"
                               placeholder="Search employee..."
                               class="form-control leave-search-input ps-5">

                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>

                    </div>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0"
                           id="leaveTable">

                        <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-uppercase small fw-bold text-muted">
                                Employee
                            </th>

                            <th class="py-3 text-uppercase small fw-bold text-muted">
                                Leave Type
                            </th>

                            <th class="py-3 text-uppercase small fw-bold text-muted">
                                Leave Date
                            </th>

                            <th class="py-3 text-uppercase small fw-bold text-muted">
                                Reason
                            </th>

                            <th class="py-3 text-uppercase small fw-bold text-muted">
                                Status
                            </th>

                            <th class="py-3 text-uppercase small fw-bold text-muted text-center"
                                width="280">
                                Actions
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(auth()->user()->hasRole('super-admin')
                       || auth()->user()->can('leave.view.self')
                       || auth()->user()->can('leave.view.all'))
                        @forelse($leaves as $leave)

                            <tr class="border-bottom">

                                <td class="px-4 py-3">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center"
                                             style="width:45px;height:45px;">

                                            {{ strtoupper(substr($leave->employee->name ?? '-',0,1)) }}

                                        </div>

                                        <div>
                                            <h6 class="mb-0 fw-semibold">
                                                {{ $leave->employee->name ?? '-' }}
                                            </h6>

                                            <small class="text-muted">
                                                Employee Leave Request
                                            </small>
                                        </div>

                                    </div>

                                </td>

                                <td>
                                    @if($leave->leave_type == 'Sick Leave')
                                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                        Sick Leave
                                    </span>
                                    @elseif($leave->leave_type == 'Casual Leave')
                                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                        Casual Leave
                                    </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                        Emergency Leave
                                    </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ \Carbon\Carbon::parse($leave->leave_date)->format('d M Y') }}
                                    </div>
                                </td>

                                <td>
                                    <div style="max-width:250px;">
                                        {{ $leave->reason }}
                                    </div>
                                </td>

                                <td>
                                    @if($leave->approval_status == 'Pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                        <i class="bi bi-clock-history me-1"></i>
                                        Pending
                                    </span>
                                    @elseif($leave->approval_status == 'Approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Approved
                                    </span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Rejected
                                    </span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        @role('employee')
                                        @can('leave.edit.self')
                                        @if($leave->approval_status == 'Pending')
                                            <a href="{{ route('leave.edit', $leave->id) }}"
                                               class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm">
                                                <i class="bi bi-pencil me-1"></i>
                                                Edit
                                            </a>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">
                                                No Action
                                            </span>
                                        @endif
                                        @endcan
                                        @endrole

                                        @if(auth()->user()->hasRole('super-admin')
                                        || auth()->user()->can('leave.approve.all')
                                        || auth()->user()->can('leave.reject.all'))

                                            @if($leave->approval_status == 'Pending'
                                                && \Carbon\Carbon::parse($leave->leave_date)->gte(\Carbon\Carbon::today()))

                                                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('leave.approve.all'))
                                                    <form action="{{ route('leave.approve', $leave->id) }}"
                                                          method="POST"
                                                          class="approve-confirm">
                                                        @csrf

                                                        <button type="submit"
                                                                class="btn btn-success btn-sm rounded-pill px-3 shadow-sm">
                                                            <i class="bi bi-check-lg me-1"></i>
                                                            Approve
                                                        </button>
                                                    </form>
                                                @endif

                                                @if(auth()->user()->hasRole('super-admin') || auth()->user()->can('leave.reject.all'))
                                                    <form action="{{ route('leave.reject', $leave->id) }}"
                                                          method="POST"
                                                          class="reject-confirm">
                                                        @csrf

                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                                                            <i class="bi bi-x-lg me-1"></i>
                                                            Reject
                                                        </button>
                                                    </form>

                                                @endif

                                            @endif

                                        @endif

                                            @role('super-admin')
                                            <form action="{{ route('leave.destroy', $leave->id) }}"
                                                  method="POST"
                                                  class="delete-confirm">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-trash me-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                            @endrole



                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center py-5">

                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-inbox display-3 text-muted mb-3"></i>

                                        <h5 class="fw-semibold text-muted">
                                            No Leave Requests Found
                                        </h5>
                                    </div>

                                </td>
                            </tr>

                        @endforelse
                        @endif
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script>
        document.getElementById('leaveSearch')
            .addEventListener('keyup', function () {

                let value = this.value.toLowerCase();

                let rows = document.querySelectorAll('#leaveTable tbody tr');

                rows.forEach(row => {

                    row.style.display =
                        row.innerText.toLowerCase().includes(value)
                            ? ''
                            : 'none';

                });

            });
    </script>

@endsection
