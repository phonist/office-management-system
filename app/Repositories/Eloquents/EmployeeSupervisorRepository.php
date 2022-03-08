<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeSupervisorRepository;
use App\EmployeeSupervisor;
use Illuminate\Http\Request;

class EmployeeSupervisorRepository implements IEmployeeSupervisorRepository{
    protected $employeeSupervisors;

    public function __construct(
        EmployeeSupervisor $employeeSupervisors
    ){
        $this->employeeSupervisors = $employeeSupervisors;
    }

    public function checkSupervisorsExistsById($id){
        return $this->employeeSupervisors->where('employee_id',$id)->first() == null ? false:true;
    }

    public function getSupervisoryById($id){
        return $this->employeeSupervisors->where('employee_id',$id)->get();
    }

    public function store(Request $request){
        $employeeSupervisor = $this->employeeSupervisors;
        $employeeSupervisor->department_id = $request->department_id;
        $employeeSupervisor->supervisor_id = $request->supervisor_id;
        $employeeSupervisor->employee_id = $request->employee_id;
        return [
            'result' => $employeeSupervisor->save(),
            'employeeSupervisor' => $employeeSupervisor
        ];
    }

    public function update(Request $request, EmployeeSupervisor $employeeSupervisor){
        $employeeSupervisor = $this->employeeSupervisors->find($employeeSupervisor->id);
        $employeeSupervisor->department_id = $request->department_id;
        $employeeSupervisor->supervisor_id = $request->supervisor_id;
        return [
            'result' => $employeeSupervisor->save(),
            'employeeSupervisor' => $employeeSupervisor
        ];
    }

    public function destroy($id){
        $employeeSupervisor = $this->employeeSupervisors->find($id);
        return $employeeSupervisor->delete();
    }
}