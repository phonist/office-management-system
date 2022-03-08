<?php

namespace App\Services;

use App\Repositories\Interfaces\IEmployeeAwardRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\EmployeeAward;
use Illuminate\Http\Request;

class EmployeeAwardService{
    protected $employeeAwards;
    protected $employees;
    protected $departments;

    public function __construct(
        IEmployeeAwardRepository $employeeAwards,
        IEmployeeRepository $employees,
        IDepartmentRepository $departments
    ){
        $this->employeeAwards = $employeeAwards;
        $this->employees = $employees;
        $this->departments = $departments;
    }

    public function all(){
        return $this->employeeAwards->all();
    }

    public function getEmployees(){
        return $this->employees->all();
    }

    public function getDepartments(){
        return $this->departments->all();
    }

    public function store(Request $request){
        return $this->employeeAwards->store($request);
    }

    public function update(Request $request, $id){
        return $this->employeeAwards->update($request, $id);
    }

    public function destroy($id){
        return $this->employeeAwards->destroy($id);
    }

    public function getById($id){
        return $this->employeeAwards->getById($id);
    }
}