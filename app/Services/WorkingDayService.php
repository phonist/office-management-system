<?php

namespace App\Services;

use App\Repositories\Interfaces\IWorkingDayRepository;
use Illuminate\Http\Request;

class WorkingDayService{
    protected $workingDays;

    public function __construct(IWorkingDayRepository $workingDays){
        $this->workingDays = $workingDays;
    }

    public function all(){
        return $this->workingDays->all();
    }

    public function store(Request $request){
        $working_days_arr = $request->working_days;
        $days_arr = $request->days;
        $enable_arr = [0,0,0,0,0,0,0];
        $day_name = ['saturday','sunday','monday','tuesday','wednesday','thursday','friday'];
        
        foreach($days_arr as $index => $day){
            foreach($working_days_arr as $w_day){
                if($w_day == $day){
                    $enable_arr[$index] = 1;
                    break;
                }else{
                    continue;
                }
            }
        }

        foreach($day_name as $index=>$name){
            $this->workingDays->updateOrCreate($day_name[$index],$enable_arr[$index]);
        }
        return [
            'result' => true
        ];
    }
}