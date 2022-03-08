<?php

namespace App\Http\Controllers;

use App\EmployeeSalary;
use Illuminate\Http\Request;
use App\Services\EmployeeSalaryService;

class EmployeeSalaryController extends Controller
{
    protected $employeeSalaries;

    public function __construct(
        EmployeeSalaryService $employeeSalaries
    ){
        $this->employeeSalaries = $employeeSalaries;
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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSalary $employeeSalary)
    {
        $result = $this->employeeSalaries->update($request, $employeeSalary);
        return redirect()->route('employees.employeeSalaries',$employeeSalary->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSalary $employeeSalary)
    {
        //
    }
}
