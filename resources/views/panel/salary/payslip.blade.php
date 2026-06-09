<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Payslip</title>

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            color:#333;
            font-size:14px;
        }

        .card{
            border:1px solid #ddd;
            border-radius:10px;
            padding:30px;
        }

        .header{
            background:#212529;
            color:white;
            padding:20px;
            border-radius:8px;
            margin-bottom:25px;
        }

        .title{
            font-size:26px;
            font-weight:bold;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table th,
        table td{
            border:1px solid #ddd;
            padding:12px;
        }

        table th{
            background:#f8f9fa;
            text-align:left;
        }

        .amount{
            text-align:right;
        }

        .paid{
            background:#198754;
            color:white;
            padding:6px 14px;
            border-radius:20px;
        }

        .footer{
            margin-top:25px;
            background:#eef6ff;
            padding:15px;
            border-radius:8px;
        }

    </style>
</head>
<body>

<div class="card">

    <div class="header">

        <div class="title">
            Employee Payslip
        </div>

        <br>

        Status :
        <span class="paid">
            {{ $salary->payment_status }}
        </span>

    </div>

    <p>
        <strong>Employee :</strong>
        {{ $salary->employee->name }}
    </p>

    <p>
        <strong>Salary Month :</strong>
        {{ $salary->salary_month }}
    </p>

    <table>

        <tr>
            <th>Basic Salary</th>
            <td class="amount">
                ₹{{ number_format($salary->basic_salary,2) }}
            </td>
        </tr>

        <tr>
            <th>Bonus</th>
            <td class="amount">
                ₹{{ number_format($salary->bonus,2) }}
            </td>
        </tr>

        <tr>
            <th>Deduction</th>
            <td class="amount">
                ₹{{ number_format($salary->deduction,2) }}
            </td>
        </tr>

        <tr>
            <th>Net Salary</th>
            <td class="amount">
                <strong>
                    ₹{{ number_format($salary->net_salary,2) }}
                </strong>
            </td>
        </tr>

    </table>

    <div class="footer">
        This is a system generated payslip.
    </div>

</div>

</body>
</html>
