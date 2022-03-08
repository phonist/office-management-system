<?php

namespace App\Http\Controllers;

use App\JobTitle;
use Illuminate\Http\Request;
use App\Services\JobTitleService;

class JobTitleController extends Controller
{
    protected $jobTitles;

    public function __construct(JobTitleService $jobTitles){
        $this->jobTitles = $jobTitles;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobTitles = $this->jobTitles->all();
        return view('admin.jobtitles.index',['jobtitles'=>$jobTitles]);
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
        $jobTitle = $this->jobTitles->store($request);
        return redirect()->action('JobTitleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function show(JobTitle $jobTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(JobTitle $jobtitle)
    {
        return response()->json($jobtitle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobTitle $jobtitle)
    {
        $jobTitle = $this->jobTitles->update($request, $jobtitle->id);
        return redirect()->action('JobTitleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTitle $jobTitle)
    {
        $jobTile = $this->jobTitle->destroy($jobTitle->id);
        return redirect()->action('JobTitleController@index');
    }
}
