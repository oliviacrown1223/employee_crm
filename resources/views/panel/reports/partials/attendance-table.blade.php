@forelse($attendances as $row)
    <tr>
        <td class="fw-semibold">
            {{ $row->employee->name ?? 'N/A' }}
        </td>

        <td>
            {{ $row->attendance_date ?? $row->date }}
        </td>

        <td>
            {{ $row->check_in ?? '-' }}
        </td>

        <td>
            {{ $row->check_out ?? '-' }}
        </td>

        <td>
            @if(strtolower($row->status) == 'present')
                <span class="badge bg-success">Present</span>
            @elseif(strtolower($row->status) == 'absent')
                <span class="badge bg-danger">Absent</span>
            @else
                <span class="badge bg-warning text-dark">
                    {{ $row->status }}
                </span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center text-muted py-4">
            No attendance records found
        </td>
    </tr>
@endforelse
