<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IJobCategoryRepository;
use App\JobCategory;
use Auth;
use Illuminate\Http\Request;

class JobCategoryRepository implements IJobCategoryRepository{
    protected $jobCategories;

    public function __construct(JobCategory $jobCategories){
        $this->jobCategories = $jobCategories;
    }

    public function all(){
        return $this->jobCategories->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }

    public function store(Request $request){
        $jobCategory = $this->jobCategories;
        $jobCategory->category = $request->category;
        $jobCategory->user_id = Auth::user()->id;
        return [
            'result' => $jobCategory->save(),
            'jobCategory' => $jobCategory
        ];
    }

    public function update(Request $request, $id){
        $jobCategory = $this->jobCategories->find($id);
        $jobCategory->category = $request->category;
        $jobCategory->user_id = Auth::user()->id;
        return [
            'result' => $jobCategory->save(),
            'jobCategory' => $jobCategory
        ];
    }

    public function destroy($id){
        $jobCategory = $this->jobCategories->find($id);
        return [
            'result' => $jobCategory->delete(),
        ];
    }
}