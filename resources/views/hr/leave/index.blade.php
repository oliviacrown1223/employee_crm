@extends('hr.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="fw-bold mb-1 text-dark">

                    HR Leave Management

                </h2>

                <p class="text-muted mb-0">

                    Review, approve and reject employee leave requests

                </p>

            </div>

            <div class="d-flex gap-2 flex-wrap">

                <span class="badge rounded-pill bg-primary-subtle text-primary px-4 py-2 fs-6">

                    Total :
                    {{ $leaves->count() }}

                </span>

                <span class="badge rounded-pill bg-warning-subtle text-warning px-4 py-2 fs-6">

                    Pending :
                    {{ $leaves->where('approval_status','Pending')->count() }}

                </span>

            </div>

        </div>

        <!-- MAIN CARD -->

        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- CARD HEADER -->

            <div class="card-header bg-dark border-0 py-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h5 class="text-white fw-semibold mb-1">

                            Leave Requests

                        </h5>

                        <small class="text-light opacity-75">

                            Human Resource Approval Panel

                        </small>

                    </div>

                    <!-- SEARCH -->

                    <div class="position-relative">

                        <input type="text"
                               id="leaveSearch"
                               class="form-control rounded-pill ps-5 shadow-none"
                               placeholder="Search employee..."
                               style="width: 260px;">

                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>

                    </div>

                </div>

            </div>

            <!-- CARD BODY -->

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
                                width="260">

                                Actions

                            </th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($leaves as $leave)

                            <tr class="border-bottom">

                                <!-- EMPLOYEE -->

                                <td class="px-4 py-3">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center shadow-sm"
                                             style="width:48px;height:48px;font-size:18px;">

                                            {{ strtoupper(substr($leave->employee->name ?? '-',0,1)) }}

                                        </div>

                                        <div>

                                            <h6 class="mb-0 fw-semibold text-dark">

                                                {{ $leave->employee->name ?? '-' }}

                                            </h6>

                                            <small class="text-muted">

                                                Employee Leave Request

                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <!-- LEAVE TYPE -->

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

                                <!-- DATE -->

                                <td>

                                    <div class="fw-semibold text-dark">

                                        {{ \Carbon\Carbon::parse($leave->leave_date)->format('d M Y') }}

                                    </div>

                                </td>

                                <!-- REASON -->

                                <td>

                                    <div style="max-width:240px;">

                                        {{ $leave->reason }}

                                    </div>

                                </td>

                                <!-- STATUS -->

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

                                <!-- ACTIONS -->

                                <td class="text-center">

                                    @if($leave->approval_status == 'Pending')

                                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                                            <!-- APPROVE -->

                                            <form action="{{ route('hr.leave.approve', $leave->id) }}"
                                                  method="POST">

                                                @csrf

                                                @if(auth()->user()->can('leave.approve.all'))

                                                    <button type="submit"
                                                            class="btn btn-success btn-sm rounded-pill px-3 shadow-sm">

                                                        <i class="bi bi-check-lg me-1"></i>

                                                        Approve

                                                    </button>

                                                @else

                                                    <button class="btn btn-secondary btn-sm rounded-pill px-3"
                                                            disabled>

                                                        No Permission

                                                    </button>

                                                @endif

                                            </form>

                                            <!-- REJECT -->

                                            <form action="{{ route('hr.leave.reject', $leave->id) }}"
                                                  method="POST">

                                                @csrf

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">

                                                    <i class="bi bi-x-lg me-1"></i>

                                                    Reject

                                                </button>

                                            </form>

                                        </div>

                                    @else

                                        <span class="text-muted small">

                                            Action Completed

                                        </span>

                                    @endif

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

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- SEARCH SCRIPT -->

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
