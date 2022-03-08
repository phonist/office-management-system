<?php

namespace App\Services;

use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Interfaces\IRoleEmployeeRepository;
use App\Repositories\Interfaces\IEmployeeAttachmentRepository;
use App\Repositories\Interfaces\IEmployeeSupervisorRepository;
use App\Repositories\Interfaces\IEmployeeSubordinateRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Repositories\Interfaces\IEmployeeDepositRepository;
use App\Repositories\Interfaces\IEmployeeLoginRepository;
use App\Repositories\Interfaces\IContactDetailRepository;
use App\Repositories\Interfaces\IEmployeeDependentRepository;
use App\Repositories\Interfaces\IEmployeeCommencementRepository;
use App\Repositories\Interfaces\IJobHistoryRepository;
use App\Repositories\Interfaces\IEmployeeStatusRepository;
use App\Repositories\Interfaces\IJobTitleRepository;
use App\Repositories\Interfaces\IWorkShiftRepository;
use App\Repositories\Interfaces\IJobCategoryRepository;
use App\Repositories\Interfaces\IEmployeeSalaryRepository;
use Illuminate\Http\Request;
use File;
use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Excel;

class EmployeeService{
    protected $roles;
    protected $employees;
    protected $roleEmployees;
    protected $employeeAttachments;
    protected $employeeSupervisors;
    protected $employeeSubordinates;
    protected $departments;
    protected $employeeDeposits;
    protected $employeeLogins;
    protected $contactDetails;
    protected $employeeDependents;
    protected $employeeCommencements;
    protected $jobHistories;
    protected $employeeStatuses;
    protected $jobTitles;
    protected $workShifts;
    protected $jobCategories;
    protected $employeeSalaries;

    public function __construct(
        IRoleRepository $roles,
        IEmployeeRepository $employees,
        IRoleEmployeeRepository $roleEmployees,
        IEmployeeAttachmentRepository $employeeAttachments,
        IEmployeeSupervisorRepository $employeeSupervisors,
        IEmployeeSubordinateRepository $employeeSubordinates,
        IDepartmentRepository $departments,
        IEmployeeDepositRepository $employeeDeposits,
        IEmployeeLoginRepository $employeeLogins,
        IContactDetailRepository $contactDetails,
        IEmployeeDependentRepository $employeeDependents,
        IEmployeeCommencementRepository $employeeCommencements,
        IJobHistoryRepository $jobHistories,
        IEmployeeStatusRepository $employeeStatuses,
        IJobTitleRepository $jobTitles,
        IWorkShiftRepository $workShifts,
        IJobCategoryRepository $jobCategories,
        IEmployeeSalaryRepository $employeeSalaries
    ){
        $this->roles = $roles;
        $this->employees = $employees;
        $this->roleEmployees = $roleEmployees;
        $this->employeeAttachments = $employeeAttachments;
        $this->employeeSupervisors = $employeeSupervisors;
        $this->employeeSubordinates = $employeeSubordinates;
        $this->departments = $departments;
        $this->employeeDeposits = $employeeDeposits;
        $this->employeeLogins = $employeeLogins;
        $this->contactDetails = $contactDetails;
        $this->employeeDependents = $employeeDependents;
        $this->employeeCommencements = $employeeCommencements;
        $this->jobHistories = $jobHistories;
        $this->employeeStatuses = $employeeStatuses;
        $this->jobTitles = $jobTitles;
        $this->workShifts = $workShifts;
        $this->jobCategories = $jobCategories;
        $this->employeeSalaries = $employeeSalaries;
    }

    public function all(){
        return $this->employees->all();
    }

    public function getRoles(){
        return $this->roles->all();
    }

    public function avatar(Request $request){
        if ($request->hasFile('employee_photo')) {
            $image = $request->file('employee_photo');
            $file_name = $image->getClientOriginalName();
            $destinationPath = public_path('/employeesPhoto');
            $image->move($destinationPath, $name);
        }else{
            $file_name = NULL;
        }
        return $file_name;
    }

    public function store(Request $request, $file_name){
        return $this->employees->store($request, $file_name);
    }

    public function downloadSample(){
        $file_path = storage_path() . "/app/downloads/employee.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=employee.csv',
        );
        return [
            'file_exists' => file_exists($file_path),
            'file_path'=> $file_path,
            'headers'=>$headers
        ];
    }

    public function import(Request $request){
        $result = [];
        if ($request->hasFile('importEmployee')) {
            $extension = File::extension($request->importEmployee->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->importEmployee->getRealPath();
                $data = Excel::import(new EmployeeImport, $request->importEmployee);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Employees Data Imported!'];
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

    public function role(Request $request, $employee){
        $role_employee = $this->roleEmployees->store($request, $employee);
        return [
            'result'=>$role_employee['result'],
            'role_employee'=>$role_employee['role_employee']
        ];
    }

    public function getTerminate(){
        return $this->employees->getTerminate();
    }

    public function checkAttachmentsExistsById($id){
        return $this->employeeAttachments->checkAttachmentsExistsById($id);
    }

    public function getAttachmentById($id){
        return $this->employeeAttachments->getAttachmentById($id);
    }

    public function checkSupervisorsExists($id){
        return $this->employeeSupervisors->checkSupervisorsExistsById($id);
    }

    public function getSupervisoryById($id){
        return $this->employeeSupervisors->getSupervisoryById($id);
    }

    public function checkSubordinatesExists($id){
        return $this->employeeSubordinates->checkSubordinatesExists($id);
    }

    public function getSubordinateById($id){
        return $this->employeeSubordinates->getSubordinateById($id);
    }

    public function getDepartments(){
        return $this->departments->all();
    }

    public function checkDepositExists($id){
        return $this->employeeDeposits->checkDepositExists($id);
    }

    public function getDepositById($id){
        return $this->employeeDeposits->getDepositById($id);
    }

    public function storeDepositById($id){
        return $this->employeeDeposits->storeDepositById($id);
    }

    public function checkLoginExists($id){
        return $this->employeeLogins->checkLoginExists($id);
    }

    public function getLoginById($id){
        return $this->employeeLogins->getLoginById($id);
    }

    public function storeLogin($id, $f_name){
        return $this->employeeLogins->storeLogin($id, $f_name);
    }

    public function update(Request $request, $id, $file_name){
        return $this->employees->update($request, $id, $file_name);
    }

    public function deleteRoleById($id){
        return $this->roleEmployees->destroy($id);
    }

    public function updatePassword($password, $id){
        return $this->employees->updatePassword($password, $id);
    }

    public function destroy($id){
        return $this->employees->destroy($id);
    }

    public function checkContactDetailExists($id){
        return $this->contactDetails->checkContactDetailExists($id);
    }

    public function getContactDetailById($id){
        return $this->contactDetails->getContactDetailById($id);
    }

    public function storeContactDetailById($id){
        return $this->contactDetails->storeContactDetailById($id);
    }

    public function checkDependentExists($id){
        return $this->employeeDependents->checkDependentExists($id);
    }

    public function getDependentById($id){
        return $this->employeeDependents->getDependentById($id);
    }

    public function checkCommencementExists($id){
        return $this->employeeCommencements->checkCommencementExists($id);
    }

    public function getCommencementById($id){
        return $this->employeeCommencements->getCommencementById($id);
    }

    public function storeCommencementById($id){
        return $this->employeeCommencements->storeCommencementById($id);
    }

    public function checkJobHistoryExists($id){
        return $this->jobHistories->checkJobHistoryExists($id);
    }

    public function getJobHistoryById($id){
        return $this->jobHistories->getJobHistoryById($id);
    }

    public function getStatuses(){
        return $this->employeeStatuses->all();
    }

    public function getJobTitles(){
        return $this->jobTitles->all();
    }

    public function getWorkShifts(){
        return $this->workShifts->all();
    }

    public function getJobCategories(){
        return $this->jobCategories->all();
    }

    public function checkSalaryExists($id){
        return $this->employeeSalaries->checkSalaryExists($id);
    }

    public function getSalaryById($id){
        return $this->employeeSalaries->getSalaryById($id);
    }

    public function storeSalaryById($id){
        return $this->employeeSalaries->storeSalaryById($id);
    }
}