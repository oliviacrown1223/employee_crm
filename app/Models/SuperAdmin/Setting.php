<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_logo',
        'website',
        'timezone',
        'currency',
        'date_format',
        'office_start_time',
        'office_end_time',
        'late_mark_time',
    ];
}
