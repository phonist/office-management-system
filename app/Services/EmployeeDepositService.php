<?php

namespace App\Services;

use App\EmployeeDeposit;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeDepositRepository;

class EmployeeDepositService{
    protected $employeeDeposits;

    public function __construct(
        IEmployeeDepositRepository $employeeDeposits
    ){
        $this->employeeDeposits = $employeeDeposits;
    }

    public function updateOrCreate(Request $request){
        return $this->employeeDeposits->updateOrCreate($request);
    }

    public function update(Request $request, EmployeeDeposit $employeeDeposit){
        return $this->employeeDeposits->update($request,$employeeDeposit);
    }
}