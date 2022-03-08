<?php

namespace App\Imports;

use App\Attendance;
use App\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'date'=>$row['date'],
            'department_id'=>Department::where('name',$row['department'])->first()->id,
            'employee_id'=>$row['employee_id'],
            'leave_id'=>$row['leave_id'],
            'in'=>$row['in'],
            'out'=>$row['out']
        ]);
    }
}
