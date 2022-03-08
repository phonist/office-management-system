<?php

namespace App\Http\Controllers;

use App\WorkingDay;
use Illuminate\Http\Request;
use App\Services\WorkingDayService;

class WorkingDayController extends Controller
{
    protected $workingDays;

    public function __construct(WorkingDayService $workingDays){
        $this->workingDays = $workingDays;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $working = $this->workingDays->all();
        return view('admin.workingdays.index',['work'=>$working]);
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
        if($request->working_days == null){
            return redirect()->action('WorkingDayController@index');
        }
        $workingDays = $this->workingDays->store($request);
        return redirect()->action('WorkingDayController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingDay $workingDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingDay $workingDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkingDay $workingDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkingDay  $workingDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingDay $workingDay)
    {
        //
    }
}
