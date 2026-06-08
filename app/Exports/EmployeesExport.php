<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping, WithDrawings,WithStyles
{
    protected $employees;
    public function styles(Worksheet $sheet)
    {
        foreach (range(2, $this->employees->count() + 1) as $row) {
            $sheet->getRowDimension($row)->setRowHeight(50);
        }

        $sheet->getColumnDimension('B')->setWidth(20);

        return [];
    }
    public function __construct()
    {
        $this->employees = Employee::all();
    }
    public function collection()
    {
        return $this->employees;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Photo',
            'Name',
            'Email',
            'Mobile',
            'Department',
            'Designation',
            'Salary',
            'Joining Date',
            'Status',
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            '', // Image column
            $employee->name,
            $employee->email,
            $employee->mobile,
            $employee->department,
            $employee->designation,
            $employee->salary,
            $employee->joining_date,
            $employee->status,
        ];
    }

    public function drawings()
    {
        $drawings = [];

        foreach ($this->employees as $index => $employee) {

            if (!$employee->photo) {
                continue;
            }

            $imagePath = storage_path('app/public/' . $employee->photo);

            if (!file_exists($imagePath)) {
                continue;
            }

            $drawing = new Drawing();

            $drawing->setName($employee->name);
            $drawing->setDescription('Employee Photo');
            $drawing->setPath($imagePath);

            $drawing->setHeight(60);

            // B column = Photo
            // Row starts from 2 because row 1 is heading
            $drawing->setCoordinates('B' . ($index + 2));

            $drawings[] = $drawing;
        }

        return $drawings;
    }

}
