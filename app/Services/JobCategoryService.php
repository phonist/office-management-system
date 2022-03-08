<?php

namespace App\Services;

use App\Repositories\Interfaces\IJobCategoryRepository;
use Illuminate\Http\Request;

class JobCategoryService{
    protected $jobCategories;

    public function __construct(IJobCategoryRepository $jobCategories){
        $this->jobCategories = $jobCategories;
    }

    public function all(){
        return $this->jobCategories->all();
    }

    public function store(Request $request){
        return $this->jobCategories->store($request);
    }

    public function update(Request $request, $id){
        return $this->jobCategories->update($request, $id);
    }

    public function destroy($id){
        return $this->jobCategories->destroy($id);
    }
}