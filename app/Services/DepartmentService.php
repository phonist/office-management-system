<?php

namespace App\Services;

use App\Repositories\Interfaces\IDepartmentRepository;
use Illuminate\Http\Request;

class DepartmentService{
    protected $departments;

    public function __construct(IDepartmentRepository $departments){
        $this->departments = $departments;
    }

    public function all(){
        return $this->departments->all();
    }

    public function store(Request $reqeust){
        return $this->departments->store($request);
    }

    public function update(Request $request, $id){
        return $this->departments->update($request, $id);
    }

    public function destroy($id){
        return $this->departments->destroy($id);
    }
}