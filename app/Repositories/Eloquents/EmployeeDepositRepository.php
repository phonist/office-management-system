<?php

namespace App\Repositories\Eloquents;

use App\EmployeeDeposit;
use App\Repositories\Interfaces\IEmployeeDepositRepository;
use Illuminate\Http\Request;

class EmployeeDepositRepository implements IEmployeeDepositRepository{
    protected $employeeDeposits;

    public function __construct(
        EmployeeDeposit $employeeDeposits
    ){
        $this->employeeDeposits = $employeeDeposits;
    }

    public function checkDepositExists($id){
        return $this->employeeDeposits->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getDepositById($id){
        return [
            'deposit'=>$this->employeeDeposits->where('employee_id',$id)->first()
        ];
    }

    public function storeDepositById($id){
        $deposit = $this->employeeDeposits;
        $deposit->employee_id = $id;
        return [
            'result' => $deposit->save(),
            'deposit' => $deposit
        ];
    }

    public function updateOrCreate(Request $request){
        $employeeDeposit = $this->employeeDeposits->updateOrCreate(
            ['employee_id'=>$request->employee_id],
            [
                'account_name'=>$request->account_name,
                'number'=>$request->account_number,
                'bank_name'=>$request->bank_name,
                'note'=>$request->note
            ]
        );
        return $employeeDeposit;
    }

    public function update(Request $request, EmployeeDeposit $employeeDeposit){
        $employeeDeposit = $this->employeeDeposits->find($employeeDeposit->id);
        $employeeDeposit->account_name = $request->account_name;
        $employeeDeposit->number = $request->account_number;
        $employeeDeposit->bank_name = $request->bank_name;
        $employeeDeposit->note = $request->note;
        return [
            'result' => $employeeDeposit->save(),
            'employeeDeposit' => $employeeDeposit
        ];
    }
}