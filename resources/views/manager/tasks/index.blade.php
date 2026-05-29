@extends('manager.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">Daily Work Management</h2>
                <p class="text-muted mb-0">Approve or reject employee submitted work</p>
            </div>

        </div>

        <!-- SUCCESS ALERT -->
        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- CARD HEADER -->
            <div class="card-header bg-dark text-white py-4 border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 fw-semibold">Work Approval Dashboard</h5>
                        <small class="text-light opacity-75">Manage employee submissions</small>
                    </div>

                </div>

            </div>

            <!-- TABLE BODY -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">
                        <tr class="text-uppercase small fw-bold text-muted">

                            <th>ID</th>
                            <th>Task Title</th>
                            <th>Description</th>
                            <th>Hours</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>

                        </tr>
                        </thead>

                        <tbody>

                        @forelse($tasks as $task)

                            <tr class="border-bottom">

                                <!-- ID -->
                                <td class="fw-semibold text-muted">
                                    #{{ $task->id }}
                                </td>

                                <!-- TITLE -->
                                <td class="fw-semibold">
                                    {{ $task->task_title }}
                                </td>

                                <!-- DESCRIPTION -->
                                <td>
                                    <span class="text-muted">
                                        {{ $task->task_description }}
                                    </span>
                                </td>

                                <!-- HOURS -->
                                <td>
                                    <span class="badge bg-dark px-3 py-2 rounded-pill">
                                        {{ $task->hours_worked }} hrs
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td>

                                    @if($task->status == 'pending')

                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            Pending
                                        </span>

                                    @elseif($task->status == 'approved')

                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            Approved
                                        </span>

                                    @else

                                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                                            Rejected
                                        </span>

                                    @endif

                                </td>

                                <!-- DATE -->
                                <td class="text-muted">
                                    {{ $task->submitted_at }}
                                </td>

                                <!-- ACTIONS -->
                                <td>

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        <!-- APPROVE -->
                                        @if(auth()->user()->can('daily_work.approve.team'))

                                            @if($task->status != 'approved')

                                                <form action="{{ route('manager.tasks.approve', $task->id) }}"
                                                      method="POST">
                                                    @csrf

                                                    <button class="btn btn-success btn-sm rounded-pill px-3 shadow-sm">
                                                        Approve
                                                    </button>

                                                </form>

                                            @else

                                                <button class="btn btn-success btn-sm rounded-pill px-3" disabled>
                                                    Approved
                                                </button>

                                            @endif

                                        @else

                                            <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                                Approve
                                            </button>

                                        @endif

                                        <!-- REJECT -->
                                        @if($task->status != 'rejected')

                                            <form action="{{ route('manager.tasks.reject', $task->id) }}"
                                                  method="POST">
                                                @csrf

                                                <button class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                                                    Reject
                                                </button>

                                            </form>

                                        @else

                                            <button class="btn btn-danger btn-sm rounded-pill px-3" disabled>
                                                Rejected
                                            </button>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox display-5 d-block mb-2"></i>
                                    No Daily Work Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- PAGINATION -->
            <div class="p-3">
                {{ $tasks->links() }}
            </div>

        </div>

    </div>

@endsection
