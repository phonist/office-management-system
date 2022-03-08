<?php

namespace App\Http\Controllers;

use App\EmployeeSubordinate;
use Illuminate\Http\Request;
use App\Services\EmployeeSubordinateService;

class EmployeeSubordinateController extends Controller
{
    protected $employeeSubordinates;

    public function __construct(
        EmployeeSubordinateService $employeeSubordinates
    ){
        $this->employeeSubordinates = $employeeSubordinates;
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
        $result = $this->employeeSubordinates->store($request);
        return redirect()->route('employees.reportTo',$request->employee_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeSubordinate  $employeeSubordinate
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSubordinate $employeeSubordinate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeSubordinate  $employeeSubordinate
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSubordinate $employeeSubordinate)
    {
        return response()->json($employeeSubordinate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeSubordinate  $employeeSubordinate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSubordinate $employeeSubordinate)
    {
        $update = EmployeeSubordinate::where('id',$employeeSubordinate->id)->update([
            'department_id'=>$request->department_id,
            'subordinate_id'=>$request->subordinate_id
        ]);
        $result = $this->employeeSubordinates->store($request,$employeeSubordinate);
        return redirect()->route('employees.reportTo',$employeeSubordinate->employee_id);
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeSubordinate  $employeeSubordinate
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSubordinate $employeeSubordinate)
    {
        
    }

    public function delete(Request $request){
        $result = $this->employeeSubordinates->destroy($request);
        return redirect()->route('employees.reportTo',$request->employee_id);
    }
}
