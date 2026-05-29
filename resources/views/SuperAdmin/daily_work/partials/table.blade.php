@forelse($works as $work)
    <tr>

        <td class="ps-3 fw-semibold">{{ $work->task_title }}</td>

        <td>
        <span class="text-muted">
            {{ Str::limit($work->task_description, 40) }}
        </span>
        </td>

        <td>
            <span class="badge bg-dark">{{ $work->hours_worked }} hrs</span>
        </td>

        <td>{{ $work->work_date }}</td>

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

                {{-- EDIT --}}
                @if(auth()->user()->role == 'super-admin')
                    <a href="{{ route('daily-work.edit',$work->id) }}"
                       class="btn btn-warning btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                       style="width:38px;height:38px;">

                        <i class="bi bi-pencil-square"></i>

                    </a>
                @endif

                {{-- APPROVE --}}
                @if(auth()->user()->role == 'manager' || auth()->user()->role == 'super-admin')

                    <form method="POST" action="{{ route('daily-work.approve',$work->id) }}">
                        @csrf
                        <button type="submit"
                                class="btn btn-success btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                style="width:38px;height:38px;">

                            <i class="bi bi-check-lg"></i>

                        </button>
                    </form>

                    <form method="POST" action="{{ route('daily-work.reject',$work->id) }}">
                        @csrf
                        <button type="submit"
                                class="btn btn-danger btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                style="width:38px;height:38px;">

                            <i class="bi bi-x-lg"></i>

                        </button>
                    </form>

                @endif

                {{-- SUBMIT --}}
                @if(auth()->user()->role == 'employee' && $work->status == 'draft')
                    <form method="POST" action="{{ route('daily-work.submit',$work->id) }}">
                        @csrf
                        <button type="submit"
                                class="btn btn-primary btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                style="width:38px;height:38px;">

                            <i class="bi bi-send"></i>

                        </button>
                    </form>
                @endif

                {{-- DELETE --}}
                @if(auth()->user()->role == 'super-admin')
                    <form method="POST" action="{{ route('daily-work.delete',$work->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-dark btn-sm d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                style="width:38px;height:38px;">

                            <i class="bi bi-trash"></i>

                        </button>
                    </form>
                @endif

            </div>

        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-4 text-muted">
            No data found
        </td>
    </tr>
@endforelse
