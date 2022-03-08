<?php

namespace App\Services;

use App\EmployeeSupervisor;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeSupervisorRepository;

class EmployeeSupervisorService {
    protected $employeeSupervisors;

    public function __construct(
        IEmployeeSupervisorRepository $employeeSupervisors
    ){
        $this->employeeSupervisors = $employeeSupervisors;
    }

    public function store(Request $request){
        return $this->employeeSupervisors->store($request);
    }

    public function update(Request $request, EmployeeSupervisor $employeeSupervisor){
        return $this->employeeSupervisors->update($request, $employeeSupervisor);
    }

    public function destroy(Request $request){
        $supervisorId_arr = $request->supervisorId;
        if($supervisorId_arr!=null){
            foreach($supervisorId_arr as $id){
                $this->employeeSupervisors->destroy((int)$id);
            }
        }
        return true;
    }
}