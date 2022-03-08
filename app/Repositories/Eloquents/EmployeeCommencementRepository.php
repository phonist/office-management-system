<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeCommencementRepository;
use App\EmployeeCommencement;
use Illuminate\Http\Request;

class EmployeeCommencementRepository implements IEmployeeCommencementRepository{
    protected $employeeCommencements;

    public function __construct(EmployeeCommencement $employeeCommencements){
        $this->employeeCommencements = $employeeCommencements;
    }
    
    public function checkCommencementExists($id){
        return $this->employeeCommencements->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getCommencementById($id){
        return [
            'employeeCommencement' => $this->employeeCommencements->where('employee_id',$id)->first()
        ];
    }

    public function storeCommencementById($id){
        $employeeCommencements = $this->employeeCommencements;
        $employeeCommencements->employee_id = $id;
        return [
            'result'=>$employeeCommencements->save(),
            'employeeCommencement' => $employeeCommencements
        ];
    }

    public function updateOrCreate(Request $request){
        $employeeCommencements = $this->employeeCommencements->updateOrCreate(
            [
                'employee_id'=>$request->employee_id
            ],
            [
                'join_date'=>$request->joined_date,
                'probation_end'=>$request->probation_end_date,
                'dop'=>$request->date_of_permanency
            ]
        );
        return [
            'result' => true,
            'employeeCommencements' => $employeeCommencements
        ];
    }
}