<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IAttendanceRepository;
use App\Attendance;

class AttendanceRepository implements IAttendanceRepository{
    protected $attendances;

    public function __construct(
        Attendance $attendances
    ){
        $this->attendances = $attendances;
    }

    public function all(){
        return $this->attendances->leftjoin('employees','attendances.employee_id','employees.id')
                    ->leftjoin('users','employees.user_id','users.id')
                    ->orderBy('attendances.created_at','asc')
                    ->get();
    }

    public function getAttendances($department_id, $date){
        return $this->attendances->where('department_id',$department_id)
                    ->where('date',$date)
                    ->get();
    }

    public function updateByDateAndDepartment($date, $department, $employee_id, $leave_id, $in, $out){
        $attendance = $this->attendances->where('date',$date)
                                        ->where('department_id',$department)
                                        ->where('employee_id',$employee_id)
                                        ->update([
                                            'leave_id'=> $leave_id,
                                            'in' => $in,
                                            'out' => $out
                                        ]);
        return [
            'attendance' => $attendance
        ];
    }

    public function updateOrCreate($id, $date, $department){
        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $id,
                'date'=> $date
            ],[
                'department_id' => $department,
            ]
        );
        return [
            'attendance' => $attendance
        ];
    }

    public function getByDateTimeAndDepartment($month, $year, $department){
        return $this->attendances->whereMonth('date',$month)
                                    ->whereYear('date',$year)
                                    ->where('department_id',$department)
                                    ->get();
    }
}