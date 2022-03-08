<?php

namespace App\Http\Controllers;

use App\WorkShift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\WorkShiftService;

class WorkShiftController extends Controller
{
    protected $workShifts;

    public function __construct(WorkShiftService $workShifts){
        $this->workShifts = $workShifts;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshifts = $this->workShifts->all();
        return view('admin.workShifts.index',['workshifts'=>$workshifts]);
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
        $workshift = $this->workShifts->store($request);
        return redirect()->action('WorkShiftController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function show(WorkShift $workShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkShift $workshift)
    {
        return response()->json($workshift);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkShift $workshift)
    {
        $workshift = $this->workShifts->update($request, $workshift->id);
        return redirect()->action('WorkShiftController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkShift  $workShift
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkShift $workshift)
    {
        //
        $this->workShifts->destroy($workshift->id);
        return redirect()->action('WorkShiftController@index');
    }
}
