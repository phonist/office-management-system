<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeAwardRepository;
use Illuminate\Http\Request;
use App\EmployeeAward;
use Carbon\Carbon;

class EmployeeAwardRepository implements IEmployeeAwardRepository{
    protected $employeeAwards;

    public function __construct(EmployeeAward $employeeAwards){
        $this->employeeAwards = $employeeAwards;
    }

    public function all(){
        return $this->employeeAwards
                    ->select('employee_awards.*')
                    ->leftjoin('employees','employee_awards.employee_id','employees.id')
                    ->leftjoin('users','employees.user_id','users.id')
                    ->orderBy('employee_awards.created_at','asc')
                    ->get();
    }

    public function store(Request $request){
        $employeeAward = $this->employeeAwards;
        $employeeAward->department_id = $request->department_id;
        $employeeAward->employee_id = $request->employee_id;
        $employeeAward->award = $request->award_name;
        $employeeAward->gift = $request->gift_item;
        $employeeAward->amount = $request->award_amount;
        $employeeAward->month = Carbon::parse($request->month)->format('Y-m-d');
        return [
            'result' => $employeeAward->save(),
            'employeeAward' => $employeeAward
        ];
    }

    public function update(Request $request, $id){
        $employeeAward = $this->employeeAwards->find($id);
        $employeeAward->department_id = $request->department_id;
        $employeeAward->employee_id = $request->employee_id;
        $employeeAward->award = $request->award_name;
        $employeeAward->gift = $request->gift_item;
        $employeeAward->amount = $request->award_amount;
        $employeeAward->month = Carbon::parse($request->month)->format('Y-m-d');
        return [
            'result' => $employeeAward->save(),
            'employeeAward' => $employeeAward
        ];
    }

    public function destroy($id){
        $employeeAward = $this->employeeAwards->find($id);
        return [
            'result' => $employeeAward->delete()
        ];
    }

    public function getById($id){
        return $this->employeeAwards->find($id);
    }
}