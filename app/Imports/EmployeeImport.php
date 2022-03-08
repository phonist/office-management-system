<?php

namespace App\Imports;

use App\Employee;
use Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'name' => $row['first_name']." ".$row['last_name'],
            'email' => $row['email'],
            'f_name' => $row['first_name'],
            'l_name' => $row['last_name'],
            'marital_status'=> $row['marital_status'],
            'dob'=> $row['dob'],
            'id_number'=> $row['id_number'],
            'gender'=> $row['gender'],
            'country'=> '-',
            'blood_group'=> '-',
            'religious'=> '-',
            'user_id' => Auth::user()->id,
            'terminate_status'=> 0,
        ]);
    }
}
