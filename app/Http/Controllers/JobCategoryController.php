<?php

namespace App\Http\Controllers;

use App\JobCategory;
use Illuminate\Http\Request;
use App\Services\JobCategoryService;

class JobCategoryController extends Controller
{
    protected $jobCategories;

    public function __construct(JobCategoryService $jobCategories){
        $this->jobCategories = $jobCategories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jobcategories = $this->jobCategories->all();
        return view('admin.jobCategories.index',['jobcategories'=>$jobcategories]);
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
        $jobCategories = $this->jobCategories->store($request);
        return redirect()->action('JobCategoryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function show(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCategory $jobCategory)
    {
        //
        return response()->json($jobCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobCategory $jobCategory)
    {
        $jobCategory = $this->jobCategories->update($request, $jobCategory->id);
        return redirect()->action('JobCategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobCategory  $jobCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobCategory $jobCategory)
    {
        //
        $this->jobCategories->destroy($jobCategory->id);
        return redirect()->action('JobCategoryController@index');
    }
}
