<?php

namespace App\Services;

use App\Repositories\Interfaces\IWorkShiftRepository;
use Illuminate\Http\Request;

class WorkShiftService {
    protected $workShifts;

    public function __construct(IWorkShiftRepository $workShifts){
        $this->workShifts = $workShifts;
    }

    public function all(){
        return $this->workShifts->all();
    }

    public function store(Request $request){
        return $this->workShifts->store($request);
    }

    public function update(Request $request, $id){
        return $this->workShifts->update($request, $id);
    }

    public function destroy($id){
        return $this->workShifts->destroy($id);
    }
}