<?php

namespace App\Http\Controllers;

use App\Attendance;
use Carbon\Carbon;
use Session;
use Response;
use Illuminate\Http\Request;
use Auth;
use App\Exports\AttendanceExport;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendances;
    public function __construct(AttendanceService $attendances){
        $this->attendances = $attendances;
    }

    public function index()
    {
        //
        if(Auth::user()->hasRole('admin')){
            $departments = $this->attendances->getDepartments();
            return view('admin.attendances.index',['departments'=>$departments]);
        }else{
            $departments = $this->attendances->getDepartments();
            $user_id     = Auth::user()->id;
            $attendances = null;
            return view('users.attendances.index',['departments'=>$departments,'id'=>$user_id,'attendances'=>$attendances]);
        }
    }

    public function setAttendance(Request $request){
        $department_id = $request->department;
        $attendances = $this->attendances->getAttendances($request->department, $request->date);
        $departments = $this->attendances->getDepartments();
        $leave = $this->attendances->getLeaveTypes();

        return view('admin.attendances.setAttendance',[
            'attendances'=>$attendances,
            'date'=>$request->date,
            'department_id'=>$department_id,
            'departments'=>$departments,
            'leave' => $leave
        ]);
    }

    public function import(){
        $employees = $this->attendances->getEmployees();
        return view('admin.attendances.import',['employees'=>$employees]);
    }

    public function download(){
        $result = $this->attendances->download();
        if ($result['result']) {
            Session::flash('success', 'File Downloaded');
            return Response::download($result['file_path'], 'attendance.csv', $result['headers']);
        } else {
            Session::flash('failure', 'Something went wrong!');
        }
        return view('admin.attendances.import');
    }

    public function importAttendance(Request $request){
        $result = $this->attendances->import($request);
        if($result['result'] && $result['status']=='success'){
            flash()->success($result['message']);
        }else if($result['result'] && $result['status']=='warning'){
            flash()->warning($result['message']);
        }else{
            flash()->error($result['message']);
        }
        return redirect()->route('employees.index'); 
    }

    public function updateAttendance(Request $request){
        $this->attendances->update($request);
        $attendances = $this->attendances->getAttendances($request->department, $request->date);
        $departments = $this->attendances->getDepartments();
        $leave = $this->attendances->getLeaveTypes();
        return redirect()->route('attendances.setAttendance',[
            'attendances'=>$attendances,
            'department'=> $request->department,
            'date'=> Carbon::parse($request->date)->format('Y-m-d'),
            'departments'=>$departments,
            'leave' => $leave
        ]);
    }

    public function store(Request $request)
    {
        if($this->attendances->checkJobHistoryExistByDepartmentId($request->department_id)){
            $result = $this->attendances->storeAttendance($request);
            $departments = $this->attendances->getDepartments();
            $department = $this->attendances->getDepartmentById($request->department_id);
            return redirect()->route('attendances.setAttendance',['department'=>$department,'date'=>$request->date]);
        }else{
            $department_id_arr = null;
            return redirect()->route('attendances.index');
        }
    }

    public function attendanceReport(Request $request){
        $departments = $this->attendances->getDepartments();
        $date = Carbon::parse($request->month);
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');
        if($request == null || $request == ""){
            $attendances = null;
            return view('admin.attendances.report',['departments'=>$departments,'attendances'=>$attendances]);
        }else{
            $attendances = $this->attendances->getByDateTimeAndDepartment($month, $year, $request->department_id);
            // $attendances = Attendance::whereMonth('date',$month)->whereYear('date',$year)->where('department_id',$request->department_id)->get();
            $numberOfDays = $date->daysInMonth;
            // $employees = JobHistory::select('employee_id')->where('department_id',$request->department_id)->get();
            $employees = $this->attendances->getJobHistoryByDepartmentId($request->department_id);
            $employee_attendance = array();
            foreach($employees as $employee){
                foreach($attendances as $attendance){
                    if($employee->employee_id == $attendance->employee_id){
                        array_push($employee_attendance, $attendance);
                    }
                }
            }
            return view('admin.attendances.report',['departments'=>$departments,'attendances'=>$attendances,'numberOfDays'=>$numberOfDays,'employees'=>$employees,'employee_attendances'=>$employee_attendance]);
        }
    }

    public function setReport(Request $request){
        $month = Carbon::parse($request->date)->format('Y-m-d');
        $department_id = $request->department_id;
        return redirect()->route('attendances.attendanceReport',['month'=>$month,'department_id'=>$department_id]);
    }

    public function edit(Attendance $attendance)
    {
        //
        return view('admin.attendances.edit',['employees'=>$employees,'department'=>$department,'date'=>$date]);
    }

    public function export(){
        return (new AttendanceExport)->download('attendance.csv');
    }
}
