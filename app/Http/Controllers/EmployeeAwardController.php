<?php

namespace App\Http\Controllers;

use App\Services\EmployeeAwardService;
use App\EmployeeAward;
use App\Employee;
use App\Department;
use App\User;
use Auth;
use Illuminate\Http\Request;

class EmployeeAwardController extends Controller
{
    protected $employeeAwards;

    public function __construct(EmployeeAwardService $employeeAwards){
        $this->employeeAwards = $employeeAwards;
    }

    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $awards = $this->employeeAwards->all();
            $employees = $this->employeeAwards->getEmployees();
            $departments = $this->employeeAwards->getDepartments();
            return view('admin.employeeAwards.index',['awards'=>$awards,'employees'=>$employees,'departments'=>$departments]);
        }else{
            // $awards = $this->employeeAwards->all();
            // $employees = $this->employeeAwards->getEmployees();
            // $departments = $this->employeeAwards->getDepartments();
            // return view('users.awards.index',['awards'=>$awards,'employees'=>$employees,'departments'=>$departments]);
        }
    }

    public function store(Request $request)
    {
        $request->month = \Carbon\Carbon::parse($request->month)->format('Y-m-d');
        $result = $this->employeeAwards->store($request);
        return redirect()->route('employeeAwards.index');
    }

    public function show(EmployeeAward $employeeAward)
    {
        //
    }

    public function edit(EmployeeAward $employeeAward)
    {
        return $this->employeeAwards->getById($employeeAward->id);
    }

    public function update(Request $request, EmployeeAward $employeeAward)
    {
        $request->month = \Carbon\Carbon::parse($request->month)->format('Y-m-d');
        $result = $this->employeeAwards->update($request, $employeeAward->id);
        return redirect()->route('employeeAwards.index');
    }


    public function destroy(EmployeeAward $employeeAward)
    {
        $result = $this->employeeAwards->destroy($employeeAward->id);
        return redirect()->route('employeeAwards.index');
    }
}
