<?php

namespace App\Services;

use App\EmployeeLogin;
use Session;
use Illuminate\Http\Request;
use App\Employee;
use App\Repositories\Interfaces\IEmployeeLoginRepository;

class EmployeeLoginService{
    protected $employeeLogins;

    public function __construct(
        IEmployeeLoginRepository $employeeLogins
    ){
        $this->employeeLogins = $employeeLogins;
    }

    public function update(Request $request, EmployeeLogin $employeeLogin){
        $result = [];
        if($request->password == $request->retype_password){
            $result = $this->employeeLogins->update($request, $employeeLogin);
            return $result;
            $result = $result['result'];
            $message = $result['message'];
        }else{
            $result = 'Failure';
            $message = 'Password and retype password does not matched!';
        }
        return [
            'result' => $result,
            'message' => $message
        ];
    }
}