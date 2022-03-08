<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeTerminationRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\EmployeeTermination;

class EmployeeTerminationService{
    protected $employeeTerminations;
    protected $employees;

    public function __construct(
        IEmployeeTerminationRepository $employeeTerminations,
        IEmployeeRepository $employees
    ){
        $this->employeeTerminations = $employeeTerminations;
        $this->employees = $employees;
    }

    public function store(Request $request){
        $status = 1;
        $result = $this->employeeTerminations->updateOrCreate($request);
        $employees = $this->employees->updateTerminationStatus($request->employee_id, $status);
        return [
            'result' => $result['result']
        ];
    }

    public function unterminate(EmployeeTermination $employeeTermination){
        $status = 0;
        $result = $this->employees->updateTerminationStatus($employeeTermination->employee_id, $status);
        return [
            'result' => $result
        ];
    }

    public function getEmployeeById($id){
        return $this->employees->getById($id);
    }

    public function update(Request $request, EmployeeTermination $employeeTermination){
        $result = $this->employeeTerminations->updateOrCreate($request);
        return [
            'result' => $result['result']
        ];
    }
}