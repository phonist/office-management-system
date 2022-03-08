<?php

namespace App\Services;

use App\Repositories\Interfaces\IApplicationRepository;
use App\Repositories\Interfaces\ILeaveTypeRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use Illuminate\Http\Request;

class ApplicationService{
    protected $applications;
    protected $leaveTypes;
    protected $employees;

    public function __construct(
        IApplicationRepository $applications,
        ILeaveTypeRepository $leaveTypes,
        IEmployeeRepository $employees
    ){
        $this->applications = $applications;
        $this->leaveTypes = $leaveTypes;
        $this->employees = $employees;
    }

    public function all(){
        return $this->applications->all();
    }

    public function getLeaveTypes(){
        return $this->leaveTypes->all();
    }

    public function getEmployees(){
        return $this->employees->all();
    }

    public function store(Request $request){
        return $this->applications->store($request);
    }

    public function update(Request $request, $id){
        return $this->applications->update($request, $id);
    }

    public function destroy($id){
        return $this->applications->destroy($id);
    }

    public function getById($id){
        return $this->applications->getById($id);
    }
}