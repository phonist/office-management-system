<?php

namespace App\Http\Controllers;

use App\EmployeeLogin;
use Session;
use Illuminate\Http\Request;
use App\Employee;
use App\Services\EmployeeLoginService;

class EmployeeLoginController extends Controller
{
    protected $employeeLogins;

    public function __construct(
        EmployeeLoginService $employeeLogins
    ){
        $this->employeeLogins = $employeeLogins;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeLogin  $employeeLogin
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeLogin $employeeLogin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeLogin  $employeeLogin
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeLogin $employeeLogin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeLogin  $employeeLogin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeLogin $employeeLogin)
    {
        $result = $this->employeeLogins->update($request, $employeeLogin);
        Session::flash($result['result'],$result['message']);
        return redirect()->route('employees.employeeLogin',$employeeLogin->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeLogin  $employeeLogin
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeLogin $employeeLogin)
    {
        //
    }
}
