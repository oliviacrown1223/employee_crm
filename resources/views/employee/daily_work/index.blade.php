@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">My Daily Work</h2>
                <p class="text-muted mb-0">Track and submit your daily tasks & progress</p>
            </div>

        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white py-4 border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 fw-semibold">Daily Work Dashboard</h5>
                        <small class="text-light opacity-75">Task tracking & submission status</small>
                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">
                        <tr class="text-uppercase small fw-bold text-muted">

                            <th>Title</th>
                            <th>Description</th>
                            <th>Hours</th>
                            <th>Work Date</th>
                            <th>Submitted At</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>

                        </tr>
                        </thead>

                        <tbody>

                        @forelse($works as $work)

                            <tr class="border-bottom">

                                <!-- TITLE -->
                                <td class="fw-semibold">
                                    {{ $work->task_title }}
                                </td>

                                <!-- DESCRIPTION -->
                                <td>
                                    <span class="text-muted">
                                        {{ Str::limit($work->task_description, 40) }}
                                    </span>
                                </td>

                                <!-- HOURS -->
                                <td>
                                    <span class="badge bg-dark px-3 py-2 rounded-pill">
                                        {{ $work->hours_worked }} hrs
                                    </span>
                                </td>

                                <!-- WORK DATE -->
                                <td>
                                    <span class="text-muted">
                                        {{ $work->work_date ?? '-' }}
                                    </span>
                                </td>

                                <!-- SUBMITTED AT -->
                                <td>
                                    <span class="text-muted">
                                        {{ $work->submitted_at ? \Carbon\Carbon::parse($work->submitted_at)->format('d M Y h:i A') : '-' }}
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td>

                                    @if($work->status == 'draft')
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">Draft</span>

                                    @elseif($work->status == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Pending</span>

                                    @elseif($work->status == 'approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Approved</span>

                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Rejected</span>
                                    @endif

                                </td>

                                <!-- ACTION -->
                                <td class="text-center">

                                    @if($work->status == 'draft')

                                        <form method="POST"
                                              action="{{ route('employee.daily-work.submit', $work->id) }}">

                                            @csrf

                                            @if(auth()->user()->can('daily_work.submit.self'))

                                                <button type="submit"
                                                        class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">

                                                    <i class="bi bi-send me-1"></i>
                                                    Submit

                                                </button>

                                            @else

                                                <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                                    Submit
                                                </button>

                                            @endif

                                        </form>

                                    @elseif($work->status == 'pending')

                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            Pending Approval
                                        </span>

                                    @elseif($work->status == 'approved')

                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            Approved
                                        </span>

                                    @else

                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            Rejected
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox display-5 d-block mb-2"></i>
                                    No work assigned
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
