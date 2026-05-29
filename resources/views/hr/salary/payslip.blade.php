<!DOCTYPE html>
<html>
<head>

    <title>Payslip</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .payslip-box{
            background:white;
            padding:40px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }

        .salary-box{
            border-radius:12px;
            padding:20px;
            color:white;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="payslip-box">

        <div class="d-flex justify-content-between align-items-center mb-5">

            <div>

                <h2 class="fw-bold">
                    Employee Payslip
                </h2>

                <p class="text-muted mb-0">

                    Salary Month :
                    {{ $salary->salary_month }}

                </p>

            </div>

            <button onclick="window.print()"
                    class="btn btn-dark">

                Print Payslip

            </button>

        </div>

        <div class="row mb-5">

            <div class="col-md-6">

                <h6 class="text-muted">
                    Employee Name
                </h6>

                <h4 class="fw-bold">
                    {{ $salary->employee->name }}
                </h4>

            </div>

            <div class="col-md-6 text-md-end">

                <h6 class="text-muted">
                    Payment Status
                </h6>

                <span class="badge bg-success p-2">

                    {{ $salary->payment_status }}

                </span>

            </div>

        </div>

        <div class="row">

            <div class="col-md-3 mb-4">

                <div class="salary-box bg-primary text-center">

                    <h6>
                        Basic Salary
                    </h6>

                    <h3 class="fw-bold">

                        ₹{{ number_format($salary->basic_salary, 2) }}

                    </h3>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="salary-box bg-success text-center">

                    <h6>
                        Bonus
                    </h6>

                    <h3 class="fw-bold">

                        ₹{{ number_format($salary->bonus, 2) }}

                    </h3>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="salary-box bg-danger text-center">

                    <h6>
                        Deduction
                    </h6>

                    <h3 class="fw-bold">

                        ₹{{ number_format($salary->deduction, 2) }}

                    </h3>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="salary-box bg-dark text-center">

                    <h6>
                        Net Salary
                    </h6>

                    <h3 class="fw-bold">

                        ₹{{ number_format($salary->net_salary, 2) }}

                    </h3>

                </div>

            </div>

        </div>

        <hr class="my-5">

        <div class="text-center">

            <h5 class="fw-bold">
                Thank You
            </h5>

            <p class="text-muted">

                This is computer generated payslip.

            </p>

        </div>

    </div>

</div>

</body>
</html>
