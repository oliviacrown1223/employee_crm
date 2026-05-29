<!DOCTYPE html>
<html>
<head>

    <title>Salary Report</title>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f4f7fb;
            font-family: sans-serif;
        }

        .report-card{
            background:#fff;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        .report-header{
            background:linear-gradient(135deg,#0d6efd,#0b5ed7);
            color:#fff;
            padding:30px;
        }

        .report-header h2{
            font-weight:700;
            margin-bottom:5px;
        }

        .table thead{
            background:#f8f9fa;
        }

        .badge-paid{
            background:#198754;
        }

        .badge-pending{
            background:#ffc107;
            color:#000;
        }

        @media print{

            .no-print{
                display:none;
            }

            body{
                background:#fff;
            }

            .report-card{
                box-shadow:none;
            }

        }

    </style>

</head>

<body>

<div class="container py-5">

    <!-- TOP BUTTON -->
    <div class="d-flex justify-content-end mb-3 no-print">

        <button onclick="window.print()"
                class="btn btn-dark rounded-3 px-4">

            <i class="bi bi-printer-fill me-2"></i>

            Print Report

        </button>

    </div>



    <!-- CARD -->
    <div class="report-card">

        <!-- HEADER -->
        <div class="report-header d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h2>

                    Salary Payroll Report

                </h2>

                <p class="mb-0 opacity-75">

                    Employee Payroll & Salary Details

                </p>

            </div>

            <div class="text-end">

                <h5 class="fw-bold mb-1">

                    {{ now()->format('d M Y') }}

                </h5>

                <small>

                    Generated Report

                </small>

            </div>

        </div>



        <!-- BODY -->
        <div class="p-4">

            <!-- SUMMARY -->
            <div class="row g-4 mb-4">

                <div class="col-md-4">

                    <div class="border rounded-4 p-4 h-100">

                        <small class="text-muted">

                            Total Payroll

                        </small>

                        <h3 class="fw-bold text-primary mt-2">

                            ₹{{ number_format($salaries->sum('net_salary')) }}

                        </h3>

                    </div>

                </div>



                <div class="col-md-4">

                    <div class="border rounded-4 p-4 h-100">

                        <small class="text-muted">

                            Total Employees

                        </small>

                        <h3 class="fw-bold text-success mt-2">

                            {{ $salaries->count() }}

                        </h3>

                    </div>

                </div>



                <div class="col-md-4">

                    <div class="border rounded-4 p-4 h-100">

                        <small class="text-muted">

                            Paid Salaries

                        </small>

                        <h3 class="fw-bold text-dark mt-2">

                            {{ $salaries->where('payment_status','Paid')->count() }}

                        </h3>

                    </div>

                </div>

            </div>



            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table align-middle table-bordered">

                    <thead>

                    <tr>

                        <th>#</th>

                        <th>Employee</th>

                        <th>Month</th>

                        <th>Basic</th>

                        <th>Bonus</th>

                        <th>Deduction</th>

                        <th>Net Salary</th>

                        <th>Status</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($salaries as $salary)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td class="fw-semibold">

                                {{ $salary->employee->name }}

                            </td>

                            <td>

                                {{ $salary->salary_month }}

                            </td>

                            <td>

                                ₹{{ number_format($salary->basic_salary) }}

                            </td>

                            <td class="text-success fw-semibold">

                                ₹{{ number_format($salary->bonus) }}

                            </td>

                            <td class="text-danger fw-semibold">

                                ₹{{ number_format($salary->deduction) }}

                            </td>

                            <td class="fw-bold text-primary">

                                ₹{{ number_format($salary->net_salary) }}

                            </td>

                            <td>

                                @if($salary->payment_status == 'Paid')

                                    <span class="badge badge-paid px-3 py-2 rounded-pill">

                                        Paid

                                    </span>

                                @else

                                    <span class="badge badge-pending px-3 py-2 rounded-pill">

                                        Pending

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5 text-muted">

                                No Salary Records Found

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>
