<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IWorkingDayRepository;
use App\WorkingDay;
use Auth;

class WorkingDayRepository implements IWorkingDayRepository{
    protected $workingDays;

    public function __construct(WorkingDay $workingDays){
        $this->workingDays = $workingDays;
    }

    public function all(){
        return $this->workingDays->where('user_id',Auth::user()->id)
                          ->orderBy('created_at','asc')
                          ->get();  
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }

    public function updateOrCreate($day, $work){
        $this->workingDays->updateOrCreate(
            ['day' => $day],
            ['work'=> $work]
        );
        return [
            'result' => true
        ];
    }
}