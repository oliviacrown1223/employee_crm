@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">
                    My Leaves
                </h2>
                <p class="text-muted mb-0">
                    Track your leave applications and approval status
                </p>
            </div>

            <!-- APPLY BUTTON -->
            <div>
                @if(auth()->user()->can('leave.apply.self'))

                    <a href="{{ route('employee.leave.create') }}"
                       class="btn btn-primary rounded-pill px-4 shadow-sm">

                        <i class="bi bi-plus-circle me-1"></i>
                        Apply Leave

                    </a>

                @else

                    <button class="btn btn-secondary rounded-pill px-4 shadow-sm" disabled>
                        No Permission
                    </button>

                @endif
            </div>

        </div>

        <!-- STATS -->
        <div class="row g-3 mb-4">

            <!-- TOTAL LEAVES -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">Total Leaves</p>
                                <h3 class="fw-bold mb-0">{{ $leaves->count() }}</h3>
                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-calendar-check fs-3 text-primary"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- PENDING -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">Pending</p>
                                <h3 class="fw-bold mb-0 text-warning">
                                    {{ $leaves->where('approval_status','Pending')->count() }}
                                </h3>
                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-clock-history fs-3 text-warning"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- APPROVED -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1">Approved</p>
                                <h3 class="fw-bold mb-0 text-success">
                                    {{ $leaves->where('approval_status','Approved')->count() }}
                                </h3>
                            </div>

                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-check-circle fs-3 text-success"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- CARD HEADER -->
            <div class="card-header bg-dark border-0 py-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <h5 class="text-white fw-semibold mb-1">Leave History</h5>
                        <small class="text-light opacity-75">Your leave request records</small>
                    </div>

                    <!-- SEARCH -->
                    <div class="position-relative">
                        <input type="text"
                               id="leaveSearch"
                               class="form-control rounded-pill ps-5"
                               placeholder="Search leave..."
                               style="width:250px;">

                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                    </div>

                </div>

            </div>

            <!-- CARD BODY -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0" id="leaveTable">

                        <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-uppercase small fw-bold text-muted">Employee</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Leave Type</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Leave Date</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Reason</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted">Status</th>
                            <th class="py-3 text-uppercase small fw-bold text-muted text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($leaves as $leave)

                            <tr class="border-bottom">

                                <!-- EMPLOYEE -->
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center shadow-sm"
                                             style="width:48px;height:48px;">
                                            {{ strtoupper(substr($leave->employee->name ?? '-',0,1)) }}
                                        </div>

                                        <div>
                                            <h6 class="mb-0 fw-semibold">
                                                {{ $leave->employee->name ?? 'No Employee' }}
                                            </h6>
                                            <small class="text-muted">Employee Leave</small>
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
                                    <span class="fw-semibold text-dark">
                                        {{ \Carbon\Carbon::parse($leave->leave_date)->format('d M Y') }}
                                    </span>
                                </td>

                                <!-- REASON -->
                                <td>
                                    <div style="max-width:220px;">
                                        {{ $leave->reason }}
                                    </div>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    @if($leave->approval_status == 'Pending')

                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            <i class="bi bi-clock-history me-1"></i> Pending
                                        </span>

                                    @elseif($leave->approval_status == 'Approved')

                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i> Approved
                                        </span>

                                    @else

                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            <i class="bi bi-x-circle me-1"></i> Rejected
                                        </span>

                                    @endif
                                </td>

                                <!-- ACTION -->
                                <td class="text-center">

                                    @if(auth()->user()->can('leave.view.self'))

                                        @if($leave->approval_status == 'Pending')

                                            <a href="{{ route('employee.leave.edit', $leave->id) }}"
                                               class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">

                                                <i class="bi bi-pencil-square me-1"></i>
                                                Edit

                                            </a>
                                            <form action="{{ route('employee-leave.destroy', $leave->id) }}"
                                                  method="POST"
                                                  style="display:inline;">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this leave?')">

                                                    Delete

                                                </button>

                                            </form>

                                        @else
                                            <span class="text-muted small">Locked</span>
                                        @endif

                                    @else

                                        <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                            No Permission
                                        </button>

                                    @endif



                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-inbox display-3 text-muted mb-3"></i>
                                        <h5 class="fw-semibold text-muted">No Leave Records Found</h5>
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
        document.getElementById('leaveSearch').addEventListener('keyup', function () {

            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#leaveTable tbody tr');

            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
            });

        });
    </script>

@endsection
