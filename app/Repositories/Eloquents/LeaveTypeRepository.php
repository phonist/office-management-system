<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\ILeaveTypeRepository;
use App\LeaveType;
use Auth;
use Illuminate\Http\Request;

class LeaveTypeRepository implements ILeaveTypeRepository{
    protected $leaveTypes;

    public function __construct(LeaveType $leaveTypes){
        $this->leaveTypes = $leaveTypes;
    }

    public function all(){
        return $this->leaveTypes->where('user_id',Auth::user()->id)->get();
    }

    public function store(Request $request){
        $leaveType = $this->leaveTypes;
        $leaveType->name = $request->leave;
        $leaveType->user_id = Auth::user()->id;
        return [
            'result' => $leaveType->save(),
            'leaveType' => $leaveType
        ];
    }

    public function update(Request $request, $id){
        $leaveType = $this->leaveTypes->find($id);
        $leaveType->name = $request->leave;
        $leaveType->user_id = Auth::user()->id;
        return [
            'result' => $leaveType->save(),
            'leaveType' => $leaveType
        ];
    }

    public function destroy($id){
        $leaveType = $this->leaveTypes->find($id);
        return [
            'result' => $leaveType->delete()
        ];
    }
}