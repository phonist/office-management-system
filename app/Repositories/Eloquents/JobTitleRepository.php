<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IJobTitleRepository;
use App\JobTitle;
use Auth;
use Illuminate\Http\Request;

class JobTitleRepository implements IJobTitleRepository{
    protected $jobTitles;

    public function __construct(
        JobTitle $jobTitles
    ){
        $this->jobTitles = $jobTitles;
    }

    public function all(){
        return $this->jobTitles->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }

    public function store(Request $request){
        $jobTitle = $this->jobTitles;
        $jobTitle->title = $request->title;
        $jobTitle->description =$request->description;
        return [
            'result' => $jobTitle->save(),
            'jobTitle' => $jobTitle
        ];
    }

    public function update(Request $request, $id){
        $jobTitle = $this->jobTitles->find($id);
        $jobTitle->title = $request->title;
        $jobTitle->description =$request->description;
        return [
            'result' => $jobTitle->save(),
            'jobTitle' => $jobTitle
        ];
    }

    public function destroy($id){
        $jobTitle = $this->jobTitles->find($id);
        return [
            'result' => $jobTitle->delete()
        ];
    }
}
