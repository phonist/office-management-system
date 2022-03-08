<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IHolidayRepository;
use App\Holiday;
use Auth;
use Illuminate\Http\Request;

class HolidayRepository implements IHolidayRepository{
    protected $holidays;

    public function __construct(Holiday $holidays){
        $this->holidays = $holidays;
    }

    public function all(){
        return $this->holidays->where('user_id',Auth::user()->id)
                              ->orderby('created_at','asc')
                              ->get();
    }

    public function store(Request $request){
        $holiday = $this->holidays;
        $holiday->name = $request->event_name;
        $holiday->description = $request->description;
        $holiday->start = $request->start_date;
        $holiday->end = $request->end_date;
        $holiday->user_id = Auth::user()->id;
        return [
            'result' => $holiday->save(),
            'holiday' => $holiday
        ];
    }

    public function update(Request $request, $id){
        $holiday = $this->holidays->find($id);
        $holiday->name = $request->event_name;
        $holiday->description = $request->description;
        $holiday->start = $request->start_date;
        $holiday->end = $request->end_date;
        $holiday->user_id = Auth::user()->id;
        return [
            'result' => $holiday->save(),
            'holiday' => $holiday
        ];
    }
    public function destroy($id){
        $holiday = $this->holidays->find($id);
        return [
            'result' => $holiday->delete()
        ];
    }
}