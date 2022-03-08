<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IDepartmentRepository;
use App\Department;
use Auth;
use Illuminate\Http\Request;

class DepartmentRepository implements IDepartmentRepository{
    protected $departments;

    public function __construct(
        Department $departments
    ){
        $this->departments = $departments;
    }

    public function all(){
        return $this->departments->where('user_id', Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }

    public function getDepartmentById($id){
        return $this->departments->where('id',$id)->first();
    }

    public function store(Request $request){
        $department = $this->departments;
        $department->name = $request->department;
        $department->description = $request->description;
        return [
            'result' => $department->save(),
            'department' => $department
        ];
    }

    public function update(Request $request, $id){
        $department = $this->departments->find($id);
        $department->name = $request->department;
        $department->description = $request->description;
        return [
            'result' => $department->save(),
            'department' => $department
        ];
    }

    public function destroy($id){
        $department = $this->department->find($id);
        return [
            'result' => $department->delete()
        ];
    }
}