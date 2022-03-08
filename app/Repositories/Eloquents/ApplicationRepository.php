<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IApplicationRepository;
use App\Application;
use Illuminate\Http\Request;

class ApplicationRepository implements IApplicationRepository{
    protected $applications;

    public function __construct(Application $applications){
        $this->applications = $applications;
    }

    public function all(){
        return $this->applications->select('applications.*')
                                  ->leftjoin('employees','applications.employee_id','employees.id')
                                  ->leftjoin('users','employees.user_id','users.id')
                                  ->orderBy('applications.created_at','asc')
                                  ->get();
    }
    
    public function store(Request $request){
        $application = $this->applications;
        $application->employee_id = $request->employee;
        $application->start = $request->start;
        $application->end = $request->end;
        $application->type_id = $request->type;
        $application->date = $request->apply;
        $application->status = 'pending';
        return [
            'result' => $application->save(),
            'application' => $application
        ];
    }

    public function update(Request $request, $id){
        $application = $this->applications->find($id);
        $application->employee_id = $request->employee;
        $application->start = $request->start;
        $application->end = $request->end;
        $application->type_id = $request->type;
        $application->date = $request->apply;
        $application->status = $request->status;
        return [
            'result' => $application->save(),
            'application' => $application
        ];
    }

    public function destroy($id){
        $application = $this->applications->find($id);
        return [
            'result' => $application->delete()
        ];
    }

    public function getById($id){
        return $this->applications->find($id);
    }
}