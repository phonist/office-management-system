<?php

namespace App\Http\Controllers;

use App\PayGrade;
use Illuminate\Http\Request;
use App\Services\PayGradeService;

class PayGradeController extends Controller
{
    protected $payGrades;

    public function __construct(PayGradeService $payGrades){
        $this->payGrades = $payGrades;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paygrades = $this->payGrades->all();
        return view('admin.paygrades.index',['paygrades'=>$paygrades]);
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
        $payGrade = $this->payGrades->store($request);
        return redirect()->action('PayGradeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function show(PayGrade $payGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(PayGrade $paygrade)
    {
        //
        return response()->json($paygrade);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayGrade $paygrade)
    {
        $payGrade = $this->payGrades->update($request, $paygrade->id);
        return redirect()->action('PayGradeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayGrade  $payGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayGrade $payGrade)
    {
        $payGrade = $this->payGrades->destroy($paygrade->id);
        return redirect()->action('PayGradeController@index');
    }
}
