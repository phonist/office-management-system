<?php

namespace App\Http\Controllers;

use App\EmployeeTermination;
use Illuminate\Http\Request;
use App\Services\EmployeeTerminationService;

class EmployeeTerminationController extends Controller
{
    protected $employeeTerminations;

    public function __construct(EmployeeTerminationService $employeeTerminations){
        $this->employeeTerminations = $employeeTerminations;
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->employeeTerminations->store($request);
        return redirect()->route('employees.show',$request->employee_id);
    }

    public function unterminate(EmployeeTermination $employeeTermination){
        $result = $this->employeeTerminations->unterminate($employeeTermination);
        return redirect()->route('employees.show',$employeeTermination->employee_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeTermination $employeeTermination)
    {
        $employee = $this->employeeTerminations->getEmployeeById($employeeTermination->employee_id);
        return view('admin.employeeTerminations.show',['employee'=>$employee, 'terminated'=>$employeeTermination]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeTermination $employeeTermination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeTermination $employeeTermination)
    {
        $resulst = $this->employeeTerminations->update($request, $employeeTermination);
        return redirect()->route('employeeTerminations.show',$employeeTermination->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeTermination $employeeTermination)
    {
        //
    }
}
