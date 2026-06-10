<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        {!! file_get_contents(public_path('assets/css/style.css')) !!}
    </style>
</head>

<body>

<div class="report-box">

    <div class="header">
        <h2>System Reports</h2>
        <p>Complete employee CRM report summary</p>
    </div>

    <table class="summary-table">
        <thead>
        <tr>
            <th>Module</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td class="module">Total Employees</td>
            <td class="value">{{ $employees }}</td>
            <td><span class="badge blue">Active</span></td>
        </tr>

        <tr>
            <td class="module">Total Attendance</td>
            <td class="value">{{ $attendance }}</td>
            <td><span class="badge green">Updated</span></td>
        </tr>

        <tr>
            <td class="module">Total Salary</td>
            <td class="value">₹ {{ number_format($salary, 2) }}</td>
            <td><span class="badge orange">Payroll</span></td>
        </tr>

        <tr>
            <td class="module">Total Daily Works</td>
            <td class="value">{{ $dailyWorks }}</td>
            <td><span class="badge green">Tracked</span></td>
        </tr>

        <tr>
            <td class="module">Total Performances</td>
            <td class="value">{{ $performances }}</td>
            <td><span class="badge blue">Generated</span></td>
        </tr>

        <tr>
            <td class="module">Total Leaves</td>
            <td class="value">{{ $leaves }}</td>
            <td><span class="badge red">Leave Data</span></td>
        </tr>
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('d M Y, h:i A') }}
    </div>

</div>

</body>
</html>
