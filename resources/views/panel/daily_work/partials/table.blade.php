@forelse($works as $work)

    <tr>

        <td class="ps-3 fw-semibold">
            {{ $work->task_title }}
        </td>

        <td>
            <span class="text-muted">
                {{ Str::limit($work->task_description, 40) }}
            </span>
        </td>

        <td>
            <span class="badge bg-dark">
                {{ $work->hours_worked }} hrs
            </span>
        </td>

        <td>
            {{ $work->work_date }}
        </td>

        <td>
            {{ $work->submitted_at ? \Carbon\Carbon::parse($work->submitted_at)->format('d M Y h:i A') : '-' }}
        </td>

        <td>
            @if($work->status == 'draft')
                <span class="badge bg-secondary">Draft</span>
            @elseif($work->status == 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
            @elseif($work->status == 'approved')
                <span class="badge bg-success">Approved</span>
            @else
                <span class="badge bg-danger">Rejected</span>
            @endif
        </td>

        <td class="text-center align-middle">

            <div class="d-flex justify-content-center align-items-center gap-2">

                @role('employee')

                @if($work->status == 'draft')

                    <form method="POST"
                          action="{{ route('daily-work.submit', $work->id) }}">
                        @csrf

                        <button type="submit"
                                class="btn btn-primary btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                style="width:38px;height:38px;"
                                title="Submit">

                            <i class="bi bi-send"></i>

                        </button>
                    </form>

                @elseif($work->status == 'pending')

                    <span class="badge bg-warning text-dark">
            Pending
        </span>

                @elseif($work->status == 'approved')

                    <span class="badge bg-success">
            Approved
        </span>

                @elseif($work->status == 'rejected')

                    <span class="badge bg-danger">
            Rejected
        </span>

                @endif

                @endrole


                @hasanyrole('super-admin|manager')

                @if($work->status == 'pending')
                    @if(auth()->user()->hasAnyRole(['super-admin'])

                             || auth()->user()->can('daily_work.approve.team'))
                    <form method="POST"
                          action="{{ route('daily-work.approve', $work->id) }}"
                           class="approve-confirm">
                        @csrf

                        <button type="submit"
                                class="btn btn-success btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                style="width:38px;height:38px;"
                                title="Approve">

                            <i class="bi bi-check-lg"></i>

                        </button>
                    </form>
                    @endif
                        @if(auth()->user()->hasAnyRole(['super-admin'])

                                  || auth()->user()->can('daily_work.reject.team'))
                    <form method="POST"
                          action="{{ route('daily-work.reject', $work->id) }}"
                          class="reject-confirm">
                        @csrf

                        <button type="submit"
                                class="btn btn-danger btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                style="width:38px;height:38px;"
                                title="Reject">

                            <i class="bi bi-x-lg"></i>

                        </button>
                    </form>
                        @endif
                @endif
                @endhasanyrole

                @role('super-admin')
                <form method="POST"
                      action="{{ route('daily-work.destroy',$work->id) }}"
                      class="delete-confirm">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-dark btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                            style="width:38px;height:38px;"
                            title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
                @endrole

            </div>

        </td>

    </tr>

@empty

    <tr>
        <td colspan="7" class="text-center py-4 text-muted">
            No data found
        </td>
    </tr>

@endforelse
