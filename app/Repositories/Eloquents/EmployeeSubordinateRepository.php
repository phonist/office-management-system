<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeSubordinateRepository;
use App\EmployeeSubordinate;
use Illuminate\Http\Request;

class EmployeeSubordinateRepository implements IEmployeeSubordinateRepository{
    protected $employeeSubordinates;

    public function __construct(
        EmployeeSubordinate $employeeSubordinates
    ){
        $this->employeeSubordinates = $employeeSubordinates;
    }

    public function checkSubordinatesExists($id){
        return $this->employeeSubordinates->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getSubordinateById($id){
        return $this->employeeSubordinates->where('employee_id',$id)->get();
    }

    public function store(Request $request){
        $employeeSubordinate = $this->employeeSubordinates;
        $employeeSubordinate->department_id = $request->department_id;
        $employeeSubordinate->subordinate_id = $request->subordinate_id;
        $employeeSubordinate->employee_id = $request->employee_id;
        return [
            'result' => $employeeSubordinate->save(),
            'employeeSubordinate' => $employeeSubordinate
        ];
    }

    public function update(Request $request, EmployeeSubordinate $employeeSubordinate){
        $employeeSubordinate = $this->employeeSubordinates->find($employeeSubordinate->id);
        $employeeSubordinate->department_id = $request->department_id;
        $employeeSubordinate->subordinate_id = $request->subordinate_id;
        return [
            'result' => $employeeSubordinate->save(),
            'employeeSubordinate' => $employeeSubordinate
        ];
    }

    public function destroy($id){
        $employeeSubordinate = $this->employeeSubordinates->find($id);
        return $employeeSubordinate->delete();
    }
}