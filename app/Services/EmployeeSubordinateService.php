<?php

namespace App\Services;

use App\EmployeeSubordinate;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeSubordinateRepository;

class EmployeeSubordinateService {
    protected $employeeSubordinates;

    public function __construct(
        IEmployeeSubordinateRepository $employeeSubordinates
    ){
        $this->employeeSubordinates = $employeeSubordinates;
    }

    public function store(Request $request){
        return $this->employeeSubordinates->store($request);
    }

    public function update(Request $request, EmployeeSubordinate $employeeSubordinate){
        return $this->employeeSubordinates->update($request,$employeeSubordinate);
    }

    public function destroy(Request $request){
        $subordinateId_arr = $request->subordinateId;
        if($subordinateId_arr!=null){
            foreach($subordinateId_arr as $id){
                $this->employeeSubordinates->destroy((int)$id);
            }
        }
        return true;
    }
}