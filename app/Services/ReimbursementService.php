<?php

namespace App\Services;

use App\Repositories\Interfaces\IReimbursementRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Department;
use Illuminate\Http\Request;

class ReimbursementService{
    protected $reimbursements;
    protected $employees;
    protected $departments;

    public function __construct(
        IReimbursementRepository $reimbursements,
        IEmployeeRepository $employees,
        IDepartmentRepository $departments
    ){
        $this->reimbursements = $reimbursements;
        $this->employees = $employees;
        $this->departments = $departments;
    }

    public function all(){
        return $this->reimbursements->all();
    }

    public function getEmployees(){
        return $this->employees->all();
    }

    public function getDepartments(){
        return $this->departments->all();
    }

    public function store(Request $request){
        return $this->reimbursements->store($request);
    }

    public function update(Request $request, $id){
        return $this->reimbursements->update($request, $id);
    }

    public function destroy($id){
        return $this->reimbursements->destroy($id);
    }
}