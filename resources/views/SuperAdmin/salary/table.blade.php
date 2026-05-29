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

            <th class="fw-semibold text-center" width="180">

                Actions

            </th>

        </tr>

        </thead>

        <tbody>

        @forelse($salaries as $salary)

            <tr>

                {{-- EMPLOYEE --}}

                <td>

                    <div class="d-flex align-items-center gap-3">

                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                             style="width:45px; height:45px; font-weight:600;">

                            {{ strtoupper(substr($salary->employee->name,0,1)) }}

                        </div>

                        <div>

                            <div class="fw-semibold">

                                {{ $salary->employee->name }}

                            </div>

                            <small class="text-muted">

                                Employee

                            </small>

                        </div>

                    </div>

                </td>

                {{-- MONTH --}}

                <td>

                    <span class="badge bg-light text-dark border px-3 py-2">

                        {{ \Carbon\Carbon::parse($salary->salary_month)->format('F Y') }}

                    </span>

                </td>

                {{-- BASIC --}}

                <td class="text-end fw-semibold">

                    ₹{{ number_format($salary->basic_salary, 2) }}

                </td>

                {{-- BONUS --}}

                <td class="text-end text-success fw-semibold">

                    + ₹{{ number_format($salary->bonus, 2) }}

                </td>

                {{-- DEDUCTION --}}

                <td class="text-end text-danger fw-semibold">

                    - ₹{{ number_format($salary->deduction, 2) }}

                </td>

                {{-- NET SALARY --}}

                <td class="text-end">

                    <span class="fw-bold text-primary">

                        ₹{{ number_format($salary->net_salary, 2) }}

                    </span>

                </td>

                {{-- STATUS --}}

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

                {{-- ACTIONS --}}

                <td>

                    <div class="d-flex justify-content-center gap-2">

                        {{-- VIEW --}}

                        <a href="{{ route('superadmin.salaries.show', $salary->id) }}"
                           class="btn btn-light border btn-sm rounded-circle d-flex align-items-center justify-content-center"
                           style="width:38px; height:38px;"
                           title="View">

                            <i class="bi bi-eye-fill text-info"></i>

                        </a>

                        {{-- EDIT --}}

                        <a href="{{ route('superadmin.salaries.edit', $salary->id) }}"
                           class="btn btn-light border btn-sm rounded-circle d-flex align-items-center justify-content-center"
                           style="width:38px; height:38px;"
                           title="Edit">

                            <i class="bi bi-pencil-fill text-warning"></i>

                        </a>

                        {{-- DELETE --}}

                        <form action="{{ route('superadmin.salaries.destroy', $salary->id) }}"
                              method="POST"
                              class="delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-light border btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:38px; height:38px;"
                                    title="Delete">

                                <i class="bi bi-trash-fill text-danger"></i>

                            </button>

                        </form>

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
