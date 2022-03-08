<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IJobHistoryRepository;
use App\JobHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobHistoryRepository implements IJobHistoryRepository{
    protected $jobHistories;

    public function __construct(JobHistory $jobHistories){
        $this->jobHistories = $jobHistories;
    }

    public function checkJobHistoryExists($id){
        return $this->jobHistories->where('employee_id',$id)->first() == null ? false:true;
    }

    public function getJobHistoryById($id){
        return $this->jobHistories->where('employee_id',$id)->get();
    }

    public function checkJobHistoryExistByDepartmentId($id){
        return $this->jobHistories->where('department_id',$id)->first() == null ? false:true;
    }

    public function getJobHistoryByDepartmentId($id){
        return $this->jobHistories->where('department_id',$id)->get();
    }

    public function store(Request $request){
        $jobHistory = $this->jobHistories;
        $jobHistory->effective_from = Carbon::parse($request->effective_from)->format('y-m-d');
        $jobHistory->department_id = $request->department;
        $jobHistory->title_id = $request->title;
        $jobHistory->category_id = $request->category;
        $jobHistory->status_id = $request->employment_status;
        $jobHistory->shift_id = $request->work_shift;
        $jobHistory->employee_id = $request->employee_id;

        return [
            'result' => $jobHistory->save(),
            'jobHistory' => $jobHistory
        ];
    }

    public function update(Request $request, JobHistory $jobHistory){
        $jobHistory = $this->jobHistories->find($jobHistory->id);
        $jobHistory->effective_from = Carbon::parse($request->effective_from)->format('y-m-d');
        $jobHistory->department_id = $request->department;
        $jobHistory->title_id = $request->title;
        $jobHistory->category_id = $request->category;
        $jobHistory->status_id = $request->employment_status;
        $jobHistory->shift_id = $request->work_shift;

        return [
            'result' => $jobHistory->save(),
            'jobHistory' => $jobHistory
        ];
    }

    public function destroy($id){
        $jobHistory = $this->jobHistories->find($id);
        return $jobHistory->delete();
    }
}