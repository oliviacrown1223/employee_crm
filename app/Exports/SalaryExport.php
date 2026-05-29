<?php

namespace App\Exports;


use App\Models\SuperAdmin\Salary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalaryExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles
{
    public function collection()
    {
        return Salary::with('employee')->latest()->get();
    }

    public function headings(): array
    {
        return [

            'ID',
            'Employee Name',
            'Basic Salary',
            'Bonus',
            'Deduction',
            'Net Salary',
            'Payment Status',
            'Salary Month',
            'Created At',

        ];
    }

    public function map($salary): array
    {
        return [

            $salary->id,

            $salary->employee->name ?? 'N/A',

            $salary->basic_salary,

            $salary->bonus,

            $salary->deduction,

            $salary->net_salary,

            $salary->payment_status,

            $salary->salary_month,

            $salary->created_at->format('d M Y'),

        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [

            // HEADER STYLE
            1 => [

                'font' => [
                    'bold' => true,
                    'size' => 13,
                ],

            ],

        ];
    }
}
