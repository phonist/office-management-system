<?php

namespace App\Services;

use App\JobHistory;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IJobHistoryRepository;

class JobHistoryService{
    protected $jobHistories;

    public function __construct(
        IJobHistoryRepository $jobHistories
    ){
        $this->jobHistories = $jobHistories;
    }

    public function store(Request $request){
        return $this->jobHistories->store($request);
    }

    public function update(Request $request, JobHistory $jobHistory){
        return $this->jobHistories->update($request, $jobHistory);
    }

    public function destroy(Request $request){
        $jobId_arr = $request->jobId;
        if($jobId_arr!=null){
            foreach($jobId_arr as $id){
                $this->jobHistories->destroy((int)$id);
            }
        }
        return true;
    }
}