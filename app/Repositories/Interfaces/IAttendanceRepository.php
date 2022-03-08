<?php

namespace App\Repositories\Interfaces;

interface IAttendanceRepository{
    public function all();
    public function getAttendances($department_id, $date);
    public function updateByDateAndDepartment($date, $department, $employee_id, $leave_id, $in, $out);
    public function updateOrCreate($id, $date, $department);
    public function getByDateTimeAndDepartment($month, $year, $department);
}