<?php

namespace App\Models;

use App\Models\SuperAdmin\Salary;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'mobile',
        'department',
        'designation',
        'salary',
        'joining_date',
        'address',
        'photo',
        'status'

    ];


    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }
    public function permissions()
    {
        return $this->hasMany(EmployeePermission::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teamMembers()
    {
        return $this->hasMany(Employee::class, 'manager_id');
    }
    public function hasEmployeePermission($permission)
    {
        return $this->permissions()
            ->where('permission', $permission)
            ->exists();
    }
}
