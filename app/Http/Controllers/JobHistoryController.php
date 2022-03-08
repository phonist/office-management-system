<?php

namespace App\Http\Controllers;

use App\JobHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\JobHistoryService;

class JobHistoryController extends Controller
{
    protected $jobHistories;

    public function __construct(
        JobHistoryService $jobHistories
    ){
        $this->jobHistories = $jobHistories;
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
        $result = $this->jobHistories->store($request);
        return redirect()->route('employees.employeeCommencements',$request->employee_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function show(JobHistory $jobHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(JobHistory $jobHistory)
    {
        return response()->json($jobHistory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobHistory $jobHistory)
    {
        $result = $this->jobHistories->update($request, $jobHistory);
        return redirect()->route('employees.employeeCommencements',$jobHistory->employee_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobHistory  $jobHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobHistory $jobHistory)
    {
        //
    }

    public function delete(Request $request){
        $result = $this->jobHistories->destroy($request);
        return redirect()->route('employees.employeeCommencements',$request->employee_id);
    }
}
