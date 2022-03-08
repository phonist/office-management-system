<?php

namespace App\Services;

use App\EmployeeDependent;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeDependentRepository;

class EmployeeDependentService{
    protected $employeeDependents;

    public function __construct(
        IEmployeeDependentRepository $employeeDependents
    ){
        $this->employeeDependents = $employeeDependents;
    }

    public function store(Request $request){
        return $this->employeeDependents->store($request);
    }

    public function update(Request $request, EmployeeDependent $employeeDependent){
        return $this->employeeDependents->update($request, $employeeDependent);
    }

    public function destroy(Request $request){
        $dependentId_arr = $request->dependentId;
        if($dependentId_arr!=null){
            foreach($dependentId_arr as $id){
                $this->employeeDependents->destroy((int)$id);
            }
        }
        return true;
    }
}