<?php

namespace App\Http\Controllers;

use App\EmployeeSupervisor;
use Illuminate\Http\Request;
use App\Services\EmployeeSupervisorService;

class EmployeeSupervisorController extends Controller
{
    protected $employeeSupervisors;

    public function __construct(
        EmployeeSupervisorService $employeeSupervisors
    ){
        $this->employeeSupervisors = $employeeSupervisors;
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
        $result = $this->employeeSupervisors->store($request);
        return redirect()->route('employees.reportTo',$request->employee_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSupervisor $employeeSupervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSupervisor $employeeSupervisor)
    {
        return response()->json($employeeSupervisor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSupervisor $employeeSupervisor)
    {
        $result = $this->employeeSupervisors->update($request, $employeeSupervisor);
        return redirect()->route('employees.reportTo',$employeeSupervisor->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSupervisor $employeeSupervisor)
    {
        //
    }

    public function delete(Request $request){
        $result = $this->employeeSupervisors->destroy($request);
        return redirect()->route('employees.reportTo',$request->employee_id);
    }
}
