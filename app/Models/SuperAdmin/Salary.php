<?php

namespace App\Models\SuperAdmin;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [

        'employee_id',
        'basic_salary',
        'bonus',
        'deduction',
        'net_salary',
        'payment_status',
        'salary_month',

    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
