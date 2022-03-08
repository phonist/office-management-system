<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Department;
use App\JobTitle;
use App\JobHistory;
use App\EmployeeSalary;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            return view('admin.payroll.index');
        }else{
            $salaries = EmployeeSalary::where('employee_id',Auth::user()->id)->get();
            return view('users.payrolls.index',['salaries'=>$salaries]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payroll.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function make_payment()
    {
        return view('admin.payroll.make_payment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSalary $payroll)
    {
        //
        $employee = User::where('id',$payroll['employee_id'])->get();
        $department     = Department::where('id',JobHistory::where('employee_id',$payroll['employee_id'])->first()->department_id)->first()->name;
        $title          = JobTitle::where('id',JobHistory::where('employee_id',$payroll['employee_id'])->first()->title_id)->first()->title;
        return response()->json([$payroll, $employee, $department, $title]);
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
