<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IWorkShiftRepository;
use App\WorkShift;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class WorkShiftRepository implements IWorkShiftRepository{
    protected $workShifts;

    public function __construct(
        WorkShift $workShifts
    ){
        $this->workShifts = $workShifts;
    }

    public function all(){
        return $this->workShifts->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }

    public function store(Request $request){
        $workShift = $this->workShifts;
        $workShift->name = $request->shift_name;
        $workShift->from = Carbon::parse($request->shift_from)->format('H:i');
        $workShift->to = Carbon::parse($request->shift_to)->format('H:i');
        $workShift->user_id = Auth::user()->id;
        return [
            'result' => $workShift->save(),
            'workShift' => $workShift
        ];
    }

    public function update(Request $request, $id){
        $workShift = $this->workShifts->find($id);
        $workShift->name = $request->shift_name;
        $workShift->from = Carbon::parse($request->shift_from)->format('H:i');
        $workShift->to = Carbon::parse($request->shift_to)->format('H:i');
        $workShift->user_id = Auth::user()->id;
        return [
            'result' => $workShift->save(),
            'workShift' => $workShift
        ];
    }

    public function destroy($id){
        $workShift = $this->workShifts->find($id);
        return [
            'result' => $workShift->delete()
        ];
    }
}