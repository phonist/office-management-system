<?php

namespace App\Services;

use App\Repositories\Interfaces\IEmployeeStatusRepository;
use Illuminate\Http\Request;

class EmployeeStatusService{
    protected $employeeStatus;

    public function __construct(IEmployeeStatusRepository $employeeStatus){
        $this->employeeStatus = $employeeStatus; 
    }

    public function all(){
        return $this->employeeStatus->all();
    }

    public function store(Request $request){
        return $this->employeeStatus->store($request);
    }

    public function update(Request $request, $id){
        return $this->employeeStatus->update($request, $id);
    }

    public function destroy($id){
        return $this->employeeStatus->destroy($id);
    }
}