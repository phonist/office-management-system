<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use App\EmployeeTermination;
use App\Repositories\Interfaces\IEmployeeTerminationRepository;

class EmployeeTerminationRepository implements IEmployeeTerminationRepository{
    protected $employeeTerminations;

    public function __construct(EmployeeTermination $employeeTerminations){
        $this->employeeTerminations = $employeeTerminations;
    }

    public function updateOrCreate(Request $request){
        $result = $this->employeeTerminations->updateOrCreate(
            [
                'employee_id'=>$request->employee_id
            ],[
                'date'=>$request->termination_date,
                'reason'=>$request->termination_reason,
                'note'=>$request->termination_note
            ]
        );
        return [
            'result' => $result
        ];
    }
}