<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeLoginRepository;
use App\EmployeeLogin;
use Illuminate\Http\Request;

class EmployeeLoginRepository implements IEmployeeLoginRepository{
    protected $employeeLogins;

    public function __construct(
        EmployeeLogin $employeeLogins
    ){
        $this->employeeLogins = $employeeLogins;
    }

    public function checkLoginExists($id){
        return $this->employeeLogins->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getLoginById($id){
        return [
            'login'=>$this->employeeLogins->where('employee_id',$id)->first()
        ];
    }

    public function storeLogin($id, $f_name){
        $login = $this->employeeLogins;
        $login->name = $f_name;
        $login->employee_id = $id;
        return [
            'result' => $login->save(),
            'login' => $login
        ];
    }

    public function update(Request $request, EmployeeLogin $employeeLogin){
        $employeeLogin = $this->employeeLogins->find($employeeLogin->employee_id);
        $employeeLogin->password = bcrypt($request->password);
        return [
            'result' => $employeeLogin->save() == true? 'Success':'Failure',
            'message' => 'Password Updated!',
            'employeeLogin' => $employeeLogin
        ];
    }
}