<?php

namespace App\Http\Controllers;

use App\EmployeeDependent;
use Illuminate\Http\Request;
use App\Services\EmployeeDependentService;

class EmployeeDependentController extends Controller
{
    protected $employeeDependents;

    public function __construct(
        EmployeeDependentService $employeeDependents
    ){
        $this->employeeDependents = $employeeDependents;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->employeeDependents->store($request);
        return redirect()->route('employees.employeeDependents',$request->employee_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeDependent  $employeeDependent
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeDependent $employeeDependent)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeDependent  $employeeDependent
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeDependent $employeeDependent)
    {
        return response()->json($employeeDependent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeDependent  $employeeDependent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeDependent $employeeDependent)
    {
        $result = $this->employeeDependents->update($request, $employeeDependent);
        return redirect()->route('employees.employeeDependents',$employeeDependent->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeDependent  $employeeDependent
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDependent $employeeDependent)
    {
        //
    }

    public function delete(Request $request){
        $result = $this->employeeDependents->destroy($request);
        return redirect()->route('employees.employeeDependents',$request->employee_id);
    }
}
