<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeStatusRepository;
use App\EmployeeStatus;
use Auth;
use Illuminate\Http\Request;

class EmployeeStatusRepository implements IEmployeeStatusRepository{
    protected $employeeStatus;

    public function __construct(EmployeeStatus $employeeStatus){
        $this->employeeStatus = $employeeStatus;
    }

    public function all(){
        return $this->employeeStatus->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }

    public function store(Request $request){
        $employeeStatus = $this->employeeStatus;
        $employeeStatus->status = $request->status;
        $employeeStatus->user_id = Auth::user()->id;
        return [
            'result' => $employeeStatus->save(),
            'employeeStatus' => $employeeStatus
        ];
    }
    
    public function update(Request $request, $id){
        $employeeStatus = $this->employeeStatus->find($id);
        $employeeStatus->status = $request->status;
        $employeeStatus->user_id = Auth::user()->id;
        return [
            'result' => $employeeStatus->save(),
            'employeeStatus' => $employeeStatus
        ];
    }

    public function destroy($id){
        $employeeStatus = $this->employeeStatus->find($id);
        return [
            'result' => $employeeStatus->delete()
        ];
    }
}