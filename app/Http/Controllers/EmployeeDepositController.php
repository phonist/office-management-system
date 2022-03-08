<?php

namespace App\Http\Controllers;

use App\EmployeeDeposit;
use Illuminate\Http\Request;
use App\Services\EmployeeDepositService;

class EmployeeDepositController extends Controller
{
    protected $employeeDeposits;

    public function __construct(
        EmployeeDepositService $employeeDeposits
    ){
        $this->employeeDeposits = $employeeDeposits;
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
        $result = $this->employeeDeposits->updateOrCreate($request);
        return redirect()->route('employees.directDeposit',$request->employee_id);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeDeposit $employeeDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeDeposit $employeeDeposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeDeposit $employeeDeposit)
    {
        $result = $this->employeeDeposits->update($request,$employeeDeposit);
        return redirect()->route('employees.directDeposit',$employeeDeposit->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDeposit $employeeDeposit)
    {
        //
    }
}
