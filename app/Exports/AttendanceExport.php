<?php

namespace App\Exports;

use App\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    /**
    * @return \Illuminate\Support\FromQuery
    */
    public function query()
    {
        return Attendance::query();
    }

    public function map($attendance): array
    {
        return [
            $attendance->date,
            $attendance->department($attendance->department_id),
            $attendance->employee($attendance->employee_id),
            $attendance->leave($attendance->leave_id),
            $attendance->in,
            $attendance->out,
            Carbon::createFromFormat('Y-m-d H:i:s', $attendance->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $attendance->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Date',
            'Deparment',
            'Employee',
            'Leave Type',
            'In Time',
            'Out Time',
            'Created At',
            'Updated At'
        ];
    }
}
