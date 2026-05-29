<!DOCTYPE html>
<html>
<head>

    <title>Salary Slip</title>

    <style>

        body{
            font-family: DejaVu Sans;
            padding:40px;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        table th,
        table td{
            border:1px solid #ddd;
            padding:12px;
            text-align:left;
        }

        table th{
            background:#f5f5f5;
        }

        h2{
            margin-bottom:5px;
        }

    </style>

</head>

<body>

<h2>Employee Salary Slip</h2>

<p>
    Monthly Payroll Information
</p>

<table>

    <tr>

        <th>Employee</th>

        <td>
            {{ $salary->employee->name }}
        </td>

    </tr>

    <tr>

        <th>Salary Month</th>

        <td>
            {{ $salary->salary_month }}
        </td>

    </tr>

    <tr>

        <th>Basic Salary</th>

        <td>
            ₹{{ number_format($salary->basic_salary) }}
        </td>

    </tr>

    <tr>

        <th>Bonus</th>

        <td>
            ₹{{ number_format($salary->bonus) }}
        </td>

    </tr>

    <tr>

        <th>Deduction</th>

        <td>
            ₹{{ number_format($salary->deduction) }}
        </td>

    </tr>

    <tr>

        <th>Net Salary</th>

        <td>
            ₹{{ number_format($salary->net_salary) }}
        </td>

    </tr>

    <tr>

        <th>Status</th>

        <td>
            {{ $salary->payment_status }}
        </td>

    </tr>

</table>

</body>
</html>
