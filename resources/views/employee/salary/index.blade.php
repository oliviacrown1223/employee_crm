@extends('employee.layout.admin')

@section('content')

    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h2 class="fw-bold mb-1 text-dark">My Salary</h2>
                <p class="text-muted mb-0">View your salary history and payment status</p>
            </div>

            <!-- TOTAL SALARY CARD -->
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body px-4 py-3">

                    <small class="text-muted d-block mb-1">Total Salary</small>

                    <h3 class="fw-bold text-success mb-0">
                        ₹{{ number_format($totalSalary) }}
                    </h3>

                </div>
            </div>

        </div>

        <!-- MAIN CARD -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- HEADER -->
            <div class="card-header bg-dark text-white py-4 border-0">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="mb-0 fw-semibold">Salary Dashboard</h5>
                        <small class="text-light opacity-75">Monthly salary breakdown</small>
                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-light">
                        <tr class="text-uppercase small fw-bold text-muted">

                            <th>Id</th>
                            <th>Employee</th>
                            <th>Month</th>
                            <th>Basic</th>
                            <th>Bonus</th>
                            <th>Deduction</th>
                            <th>Net Salary</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>

                        </tr>
                        </thead>

                        <tbody>

                        @forelse($salaries as $salary)

                            <tr class="border-bottom">

                                <!-- ID -->
                                <td class="fw-semibold text-muted">
                                    #{{ $salary->id }}
                                </td>

                                <!-- EMPLOYEE -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">

                                        <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center shadow-sm"
                                             style="width:40px;height:40px;">
                                            {{ strtoupper(substr($salary->employee->name,0,1)) }}
                                        </div>

                                        <div class="fw-semibold">
                                            {{ $salary->employee->name }}
                                        </div>

                                    </div>
                                </td>

                                <!-- MONTH -->
                                <td>
                                    <span class="badge bg-dark-subtle text-dark rounded-pill px-3 py-2">
                                        {{ $salary->salary_month }}
                                    </span>
                                </td>

                                <!-- BASIC -->
                                <td class="fw-semibold">
                                    ₹{{ number_format($salary->basic_salary) }}
                                </td>

                                <!-- BONUS -->
                                <td class="text-success fw-semibold">
                                    ₹{{ number_format($salary->bonus) }}
                                </td>

                                <!-- DEDUCTION -->
                                <td class="text-danger fw-semibold">
                                    ₹{{ number_format($salary->deduction) }}
                                </td>

                                <!-- NET -->
                                <td class="fw-bold text-primary">
                                    ₹{{ number_format($salary->net_salary) }}
                                </td>

                                <!-- STATUS -->
                                <td>
                                    @if($salary->payment_status == 'Paid')

                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            Paid
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            Pending
                                        </span>

                                    @endif
                                </td>

                                <!-- ACTION -->
                                <td class="text-center">

                                    @can('salary.view.self')

                                        <a href="{{ route('employee.salary.show', $salary->id) }}"
                                           class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm">

                                            <i class="bi bi-eye me-1"></i>
                                            View

                                        </a>

                                    @else

                                        <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled>
                                            View
                                        </button>

                                    @endcan

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox display-5 d-block mb-2"></i>
                                    No Salary Records Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <!-- PAGINATION -->
                <div class="p-3">
                    {{ $salaries->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection
