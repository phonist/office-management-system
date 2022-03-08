<?php

namespace App\Http\Controllers;

use App\EmployeeStatus;
use Illuminate\Http\Request;
use App\Services\EmployeeStatusService;

class EmployeeStatusController extends Controller
{
    protected $employeeStatus;

    public function __construct(EmployeeStatusService $employeeStatus){
        $this->employeeStatus = $employeeStatus;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = $this->employeeStatus->all();
        return view('admin.employeestatus.index',['status'=>$status]);
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
        $employeeStatus = $this->employeeStatus->store($request);
        return redirect()->route('employeestatus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeStatus $employeeStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeStatus $employeestatus)
    {
        //
        return response()->json($employeestatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeStatus $employeestatus)
    {
        $employeeStatus = $this->employeeStatus->store($request, $employeestatus->id);
        return redirect()->route('employeestatus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeStatus $employeeStatus)
    {
        $employeeStatus = $this->employeeStatus->destroy($employeeStatus->id);
        return redirect()->route('employeestatus.index');
    }
}
