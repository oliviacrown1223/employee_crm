<div class="table-responsive">

    <table class="table align-middle table-hover">

        <thead class="table-light">
        <tr>
            <th class="fw-semibold">Employee</th>
            <th class="fw-semibold">Salary Month</th>
            <th class="fw-semibold text-end">Basic</th>
            <th class="fw-semibold text-end">Bonus</th>
            <th class="fw-semibold text-end">Deduction</th>
            <th class="fw-semibold text-end">Net Salary</th>
            <th class="fw-semibold text-center">Status</th>
            <th class="fw-semibold text-center" width="180">Actions</th>
        </tr>
        </thead>

        <tbody>

        @forelse($salaries as $salary)

            <tr>
                <td>
                    <div class="d-flex align-items-center gap-3">

                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center employee-logo">
                            {{ strtoupper(substr($salary->employee->name,0,1)) }}
                        </div>

                        <div>
                            <div class="fw-semibold">
                                {{ $salary->employee->name }}
                            </div>
                            <small class="text-muted">Employee</small>
                        </div>

                    </div>
                </td>

                <td>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        {{ \Carbon\Carbon::parse($salary->salary_month)->format('F Y') }}
                    </span>
                </td>

                <td class="text-end fw-semibold">
                    ₹{{ number_format($salary->basic_salary, 2) }}
                </td>

                <td class="text-end text-success fw-semibold">
                    + ₹{{ number_format($salary->bonus, 2) }}
                </td>

                <td class="text-end text-danger fw-semibold">
                    - ₹{{ number_format($salary->deduction, 2) }}
                </td>

                <td class="text-end">
                    <span class="fw-bold text-primary">
                        ₹{{ number_format($salary->net_salary, 2) }}
                    </span>
                </td>

                <td class="text-center">
                    @if($salary->payment_status == 'Paid')
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                            Paid
                        </span>
                    @else
                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                            Pending
                        </span>
                    @endif
                </td>

                <td class="text-center">

                    <div class="d-flex justify-content-center align-items-center gap-2">

                        @if(auth()->user()->hasAnyRole(['super-admin', 'manager'])
                            || auth()->user()->can('salary.view.self')
                            || auth()->user()->can('salary.view.all'))

                            <a href="{{ route('salary.show', $salary->id) }}"
                               class="btn btn-primary btn-sm rounded-circle shadow-sm"
                               title="View">
                                <i class="bi bi-eye-fill"></i>
                            </a>

                        @endif


                            @if(auth()->user()->hasAnyRole(['super-admin', 'manager'])
                               || auth()->user()->can('salary.edit.all'))

                        <a href="{{ route('salary.edit', $salary->id) }}"
                           class="btn btn-warning btn-sm rounded-circle shadow-sm"
                           title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                            @endif


                        @role('super-admin')

                        <form action="{{ route('salary.destroy', $salary->id) }}"
                              method="POST"
                              class="delete-confirm">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm rounded-circle shadow-sm"
                                    title="Delete">

                                <i class="bi bi-trash-fill"></i>

                            </button>

                        </form>

                        @endrole

                    </div>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="8" class="text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-cash-stack fs-1 d-block mb-3"></i>
                        No Salary Records Found
                    </div>
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>
