<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeDependentRepository;
use App\EmployeeDependent;
use Illuminate\Http\Request;

class EmployeeDependentRepository implements IEmployeeDependentRepository{
    protected $employeeDependents;

    public function __construct(EmployeeDependent $employeeDependents){
        $this->employeeDependents = $employeeDependents;
    }

    public function checkDependentExists($id){
        return $this->employeeDependents->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getDependentById($id){
        return $this->employeeDependents->where('employee_id',$id)->get();
    }

    public function store(Request $request){
        $employeeDependent = $this->employeeDependents;
        $employeeDependent->name = $request->name;
        $employeeDependent->relationship = $request->relationship;
        $employeeDependent->dob = $request->date_of_birth;
        $employeeDependent->employee_id = $request->employee_id;
        return [
            'result' => $employeeDependent->save(),
            'employeeDependent' => $employeeDependent
        ];
    }

    public function update(Request $request, EmployeeDependent $employeeDependent){
        $employeeDependent = $this->employeeDependents->find($employeeDependent->id);
        $employeeDependent->name = $request->name;
        $employeeDependent->relationship = $request->relationship;
        $employeeDependent->dob = $request->date_of_birth;
        return [
            'result' => $employeeDependent->save(),
            'employeeDependent' => $employeeDependent
        ];
    }

    public function destroy($id){
        $employeeDependent = $this->employeeDependents->find($id);
        return $employeeDependent->delete();
    }
}