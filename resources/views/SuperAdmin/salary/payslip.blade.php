<h2>
    Employee Payslip
</h2>

<hr>

<p>
    Employee :
    {{ $salary->employee->name }}
</p>

<p>
    Salary Month :
    {{ $salary->salary_month }}
</p>

<p>
    Basic Salary :
    ₹{{ $salary->basic_salary }}
</p>

<p>
    Bonus :
    ₹{{ $salary->bonus }}
</p>

<p>
    Deduction :
    ₹{{ $salary->deduction }}
</p>

<p>
    Net Salary :
    ₹{{ $salary->net_salary }}
</p>

<p>
    Status :
    {{ $salary->payment_status }}
</p>
