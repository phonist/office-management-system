<?php

namespace App\Services;

use App\Repositories\Interfaces\IJobTitleRepository;
use Illuminate\Http\Request;

class JobTitleService{
    protected $jobTitles;

    public function __construct(IJobTitleRepository $jobTitles){
        $this->jobTitles = $jobTitles;
    }

    public function all(){
        return $this->jobTitles->all();
    }

    public function store(Request $request){
        return $this->jobTitles->store($request);
    }

    public function update(Request $request, $id){
        return $this->jobTitles->update($request, $id);
    }

    public function destroy($id){
        return $this->jobTitles->destroy($id);
    }
}