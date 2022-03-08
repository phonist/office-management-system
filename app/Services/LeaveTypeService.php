<?php

namespace App\Services;

use App\Repositories\Interfaces\ILeaveTypeRepository;
use Illuminate\Http\Request;

class LeaveTypeService {
    protected $leaveTypes;

    public function __construct(ILeaveTypeRepository $leaveTypes){
        $this->leaveTypes = $leaveTypes;
    }

    public function all(){
        return $this->leaveTypes->all();
    }

    public function store(Request $request){
        return $this->leaveTypes->store($request);
    }

    public function update(Request $request, $id){
        return $this->leaveTypes->update($request, $id);
    }

    public function destroy($id){
        return $this->leaveTypes->destroy($id);
    }
}