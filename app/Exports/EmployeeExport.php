<?php

namespace App\Exports;

use App\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Employee::query();
    }

    public function map($employee): array
    {
        return [
            $employee->name,
            $employee->email,
            $employee->dob,
            $employee->marital_status,
            $employee->country,
            $employee->blood_group,
            $employee->id_number,
            $employee->religious,
            $employee->gender,
            $employee->terminate_status,
            Carbon::createFromFormat('Y-m-d H:i:s', $employee->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $employee->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Dob',
            'Marital Status',
            'Country',
            'Blood Group',
            'Id number',
            'Religious',
            'Gender',
            'Terminate Status',
            'Created At',
            'Updated At'
        ];
    }
}
