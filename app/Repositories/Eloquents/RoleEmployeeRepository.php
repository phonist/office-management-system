<?php

namespace App\Repositories\Eloquents;

use App\Employee;
use App\RoleEmployee;
use Auth;
use App\Repositories\Interfaces\IRoleEmployeeRepository;
use Illuminate\Http\Request;

class RoleEmployeeRepository implements IRoleEmployeeRepository{
    protected $roleEmployees;

    public function __construct(RoleEmployee $roleEmployees){
        $this->roleEmployees = $roleEmployees;
    }

    public function store(Request $request, $employee){
        $role_employee = $this->roleEmployees;
        $role_employee->role_id = $request->role;
        $role_employee->employee_id = $employee['employee']->id;
        return [
            'result' => $role_employee->save(),
            'role_employee' => $role_employee
        ];
    }

    public function destroy($id){
        $delete = $this->roleEmployees->where('employee_id',$id);
        return [
            'result' => $delete->delete()
        ];
    }
}