<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;
use App\Employee;
use Session;
use Response;
use Auth;

class EmployeeController extends Controller
{
    protected $employees;

    public function __construct(
        EmployeeService $employees
    ){
        $this->employees = $employees;
    }
  
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $employees = $this->employees->all();
            return view('admin.employees.index',['employees'=>$employees]);
        }
        // }else{
        //     $users = User::where('id',Auth::user()->id)->first();
        //     return view('users.profiles.index',['user'=>$users]);
        // }
    }

    public function create()
    {
        $roles = $this->employees->getRoles();
        return view('admin.employees.create',['roles'=>$roles]);
    }


    public function add(Request $request){
        $file_name = $this->employees->avatar($request);
        $employee = $this->employees->store($request, $file_name);
        return redirect()->action('EmployeeController@index');   
    }

    /*
    *Import a list of employees from csv files
    */
    public function import(){
        return view('admin.employees.import');
    }

    public function downloadSample(){
        $result = $this->employees->downloadSample();
        if ($result['file_exists']) {
            flash()->success('File Downloaded');
            return Response::download($result['file_path'], 'employee.csv', $result['headers']);
        } else {
            flash()->error('Something went wrong!');
        }
        return redirect()->route('employees.import');
    }

    public function importEmployee(Request $request){
        $result = $this->employees->import($request);
        if($result['result'] && $result['status']=='success'){
            flash()->success($result['message']);
        }else if($result['result'] && $result['status']=='warning'){
            flash()->warning($result['message']);
        }else{
            flash()->error($result['message']);
        }
        return redirect()->route('employees.index'); 
    }

    public function store(Request $request)
    {
        $file_name = $this->employees->avatar($request);
        $employee = $this->employees->store($request, $file_name);
        $role_employee = $this->employees->role($request, $employee);
        return redirect()->route('employees.index');
    }

    public function terminate(Request $request){
        return response()->json($request);
    }

    public function terminateList(){
        $employees = $this->employees->getTerminate();
        return view('admin.employees.terminate',['employees'=>$employees]);
    }

    public function show(Employee $employee)
    {   
        $roles = $this->employees->getRoles();
        if($this->employees->checkAttachmentsExistsById($employee->id)){
            $employee_attachments = $this->employees->getAttachmentById($employee->id);
        }else{
            $employee_attachments = null;
        }
        if(Auth::user()->hasRole('admin')){
            return view('admin.employees.show',['employee'=>$employee,'attachments'=>$employee_attachments,'roles'=>$roles]);
        }else{
            return view('users.profiles.index',['user'=>$employee,'attachments'=>$employee_attachments]);
        }
    }

    public function reportTo(Employee $employee){
        if($this->employees->checkSupervisorsExists($employee->id)){
            $supervisors = $this->employees->getSupervisoryById($employee->id);
        }else{
            $supervisors = null;
        }

        if($this->employees->checkSubordinatesExists($employee->id)){
            $subordinates = $this->employees->getSubordinateById($employee->id);
        }else{
            $subordinates = null;
        }
        $employees = $this->employees->all();
        $departments = $this->employees->getDepartments();
        
        return view('admin.employeeReportTo.index',[
            'employee'=>$employee,
            'supervisors'=>$supervisors,
            'employees'=>$employees,
            'subordinates'=>$subordinates,
            'departments'=>$departments
        ]);
    }

    public function directDeposit(Employee $employee){
        if($this->employees->checkDepositExists($employee->id)){
            $deposit = $this->employees->getDepositById($employee->id);
        }else{
            $deposit = $this->employees->storeDepositById($employee->id);
        }
        return view('admin.employeeDirectDeposit.index',['employee'=>$employee,'deposit'=>$deposit['deposit']]);
    }

    public function employeeLogin(Employee $employee){
        if($this->employees->checkLoginExists($employee->id)){
            $login = $this->employees->getLoginById($employee->id);
        }else{
            $login = $this->employees->storeLogin($employee->id, $employee->f_name);
        }
        return view('admin.employeeLogins.index',['employee'=>$employee,'login'=>$login['login']]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        if(Auth::user()->hasRole('admin')){
            $file_name = $this->employees->avatar($request);
            $employee = $this->employees->update($request, $employee->id, $file_name);
            $delete = $this->employees->deleteRoleById($employee['employee']->id);
            $role_employee = $this->employees->role($request, $employee);
            return redirect()->route('employees.show',$employee['employee']->id);
        }else{
            $update = $this->employees->updatePassword($request->password, $employee->id);
            return redirect()->route('employees.show',$employee->id);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $delete = $this->employees->destroy($employee->id);
        if($delete['result']){
            Session::flash('success', 'Employee Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('employees.index');
    }

    public function delete(Employee $employee){
        $delete = $this->employees->destroy($employee->id);
        if($delete['result']){
            Session::flash('success', 'Employee Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('employees.index');
    }

    public function contactDetails(Employee $employee){
        if($this->employees->checkContactDetailExists($employee->id)){
            $contactDetailId = $this->employees->getContactDetailById($employee->id);
        }else{
            $contactDetailId = $this->employees->storeContactDetailById($employee->id);
        }
        return redirect()->route('contactDetails.show',$contactDetailId['contactDetail']->id);
    }

    public function employeeDependents(Employee $employee){
        if($this->employees->checkDependentExists($employee->id)){
            $dependents = $this->employees->getDependentById($employee->id);
        }else{
            $dependents = null;
        }
        return view('admin.employeeDependents.index',['dependents'=>$dependents,'employee'=>$employee]);
    }

    public function employeeCommencements(Employee $employee){
        if($this->employees->checkCommencementExists($employee->id)){
            $commencements = $this->employees->getCommencementById($employee->id);
        }else{
            $commencements = $this->employees->storeCommencementById($employee->id);
        }
        
        if($this->employees->checkJobHistoryExists($employee->id)){
            $jobHistories = $this->employees->getJobHistoryById($employee->id);
        }else{
            $jobHistories = null;
        }
        $departments = $this->employees->getDepartments();
        $employeeStatuses = $this->employees->getStatuses();
        $jobTitles = $this->employees->getJobTitles();
        $workShifts = $this->employees->getWorkShifts();
        $jobCategories = $this->employees->getJobCategories();
        return view('admin.employeeCommencements.index',[
            'employee'=>$employee,
            'commencement'=>$commencements['employeeCommencement'],
            'jobHistories'=>$jobHistories,
            'departments'=>$departments,
            'employeeStatuses'=>$employeeStatuses,
            'jobTitles'=>$jobTitles,
            'workShifts'=>$workShifts,
            'jobCategories'=>$jobCategories
        ]);
    }

    public function employeeSalaries(Employee $employee){
        if($this->employees->checkSalaryExists($employee->id)){
            $salary = $this->employees->getSalaryById($employee->id);
        }else{
            $salary = $this->employees->storeSalaryById($employee->id);
        }
        return view('admin.employeeSalaries.index',[
            'employee'=>$employee,
            'salary'=>$salary['salary']
        ]);
    }
}
