<?php

namespace App\Services;

use App\Repositories\Interfaces\IAttendanceRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Repositories\Interfaces\ILeaveTypeRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Interfaces\IJobHistoryRepository;
use File;
use Excel;
use App\Imports\AttendanceImport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceService {
    protected $attendances;

    public function __construct(
        IAttendanceRepository $attendances,
        IDepartmentRepository $departments,
        ILeaveTypeRepository $leaveTypes,
        IEmployeeRepository $employees,
        IJobHistoryRepository $jobHistories
    ){
        $this->attendances = $attendances;
        $this->departments = $departments;
        $this->leaveTypes = $leaveTypes;
        $this->employees = $employees;
        $this->jobHistories = $jobHistories;
    }

    public function getDepartments()
    {
        return $this->departments->all();
    }

    public function getAttendances($department_id, $date)
    {
        return $this->attendances->getAttendances($department_id, $date);
    }

    public function getLeaveTypes(){
        return $this->leaveTypes->all();
    }

    public function getEmployees(){
        return $this->employees->all();
    }

    public function download(){
        $file_path = storage_path() . "/app/downloads/attendance.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=attendance.csv',
        );
        return [
            'result' => file_exists($file_path),
            'file_path' => $file_path,
            'headers' => $headers
        ];
    }

    public function import(Request $request){
        if ($request->hasFile('importAttendance')) {
            $extension = File::extension($request->importAttendance->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->importAttendance->getRealPath();
                $data = Excel::import(new AttendanceImport, $request->importAttendance);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Attendances Imported!'];
                }else{
                    $result = ['result'=>false, 'status'=>'warning','message'=>'There is no data in csv file!'];
                }
            }else{
                $result = ['result'=>false, 'status'=>'warning','message'=>'Selected file is not csv!'];
            }
        }else{
            $result = ['result'=>false, 'status'=>'warning','message'=>'Something went wrong!'];
        }
        return $result;
    }

    public function update(Request $request){
        for($i = 0; $i< count($request->employee_id); $i++){
            $result = $this->attendances->updateByDateAndDepartment(
                Carbon::parse($request->date)->format('Y-m-d'),
                $request->department,
                $request->employee_id[$i],
                $request->leave_category_id[$i],
                Carbon::parse($request->in[$i])->format('H:i'),
                Carbon::parse($request->out[$i])->format('H:i')
            );
        }
        return [
            'result' => $result
        ];
    }

    public function checkJobHistoryExistByDepartmentId($id){
        return $this->jobHistories->checkJobHistoryExistByDepartmentId($id);
    }

    public function getJobHistoryByDepartmentId($id){
        return $this->jobHistories->getJobHistoryByDepartmentId($id);
    }

    public function getDepartmentById($id){
        return $this->departments->getDepartmentById($id);
    }

    public function storeAttendance(Request $request){
        $department_id_arr = $this->jobHistories->getJobHistoryByDepartmentId($request->department_id);
        $employees = [];
        foreach($department_id_arr as $id){
            $employee = $this->employees->getById($id['employee_id']);
            // $employee = Employee::where('id',$id['employee_id'])->first();
            array_push($employees,$employee);
            $store = $this->attendances->updateOrCreate(
                $id['employee_id'],
                Carbon::parse($request->date)->format('Y-m-d'),
                $request->department_id
            );
        }
        return [
            'result' => true
        ];
    }

    public function getByDateTimeAndDepartment($month, $year, $deparment){
        return $this->attendances->getByDateTimeAndDepartment($month, $year, $deparment);
    }
}