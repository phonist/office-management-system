<?php

namespace App\Repositories\Eloquents;

use App\Employee;
use Auth;
use App\Repositories\Interfaces\IEmployeeRepository;
use Illuminate\Http\Request;

class EmployeeRepository implements IEmployeeRepository{
    protected $employees;

    public function __construct(Employee $employees){
        $this->employees = $employees;
    }

    public function all(){
        return $this->employees->where('user_id',Auth::user()->id)
                                ->where('terminate_status',0)
                                ->orderBy('created_at','asc')
                                ->get();
    }

    public function store(Request $request, $file_name){
        $employee = $this->employees;
        $employee->name = $request->first_name." ".$request->last_name;
        $employee->email = $request->email;
        $employee->f_name = $request->first_name;
        $employee->l_name = $request->last_name;
        $employee->dob = $request->date_of_birth;
        $employee->marital_status = $request->marital_status;
        $employee->country = $request->country;
        $employee->blood_group = $request->blood_group;
        $employee->id_number = $request->id_number;
        $employee->religious = $request->religious;
        $employee->gender = $request->gender;
        $employee->photo = $file_name;
        $employee->terminate_status = 0;
        $employee->user_id = Auth::user()->id;
        return [
            'result'=>$employee->save(),
            'employee'=>$employee
        ];
    }

    public function getTerminate(){
        return $this->employees->where('user_id',Auth::user()->id)
                                ->where('terminate_status',1)
                                ->orderBy('created_at','asc')
                                ->get();
    }

    public function update(Request $request, $id, $file_name){
        $employee = $this->employees->find($id);
        $employee->name = $request->first_name." ".$request->last_name;
        $employee->email = $request->email;
        $employee->f_name = $request->first_name;
        $employee->l_name = $request->last_name;
        $employee->dob = $request->date_of_birth;
        $employee->marital_status = $request->marital_status;
        $employee->country = $request->country;
        $employee->blood_group = $request->blood_group;
        $employee->id_number = $request->id_number;
        $employee->religious = $request->religious;
        $employee->gender = $request->gender;
        $employee->photo = $file_name;
        return [
            'result' => $employee->save(),
            'employee' => $employee
        ];
    }

    public function updatePassword($password, $id){
        $employee = $this->employees->find($id);
        $employee->password = $password;
        return [
            'result' => $employee->save(),
            'employee' => $employee
        ];
    }

    public function destroy($id){
        $employee = $this->employees->find($id);
        return [
            'result' => $employee->delete()
        ];
    }

    public function getById($id){
        return $this->employees->where('id',$id)->first();
    }

    public function updateTerminationStatus($id, $status){
        $this->employees->where('id',$id)->update([
            'terminate_status'=>$status
        ]);
        return true;
    }
}