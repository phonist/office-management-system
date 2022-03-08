<?php

namespace App\Http\Controllers;

use App\SalaryComponent;
use Illuminate\Http\Request;
use App\Services\SalaryComponentService;

class SalaryComponentController extends Controller
{
    protected $salaryComponents;

    public function __construct(SalaryComponentService $salaryComponents){
        $this->salaryComponents = $salaryComponents;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salaries = $this->salaryComponents->all();
        return view('admin.salarycomponents.index',['salaries'=>$salaries]);
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
        $salaryComponent = $this->salaryComponents->store($request);
        return redirect()->action('SalaryComponentController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryComponent $salaryComponent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryComponent $salarycomponent)
    {
        //
        return response()->json($salarycomponent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryComponent $salarycomponent)
    {
        $salaryComponent = $this->salaryComponents->update($request, $salarycomponent->id);
        return redirect()->action('SalaryComponentController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalaryComponent  $salaryComponent
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryComponent $salaryComponent)
    {
        $salaryComponent = $this->salaryComponents->destroy($salaryComponent->id);
        return redirect()->action('SalaryComponentController@index');
    }
}
