<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;
use App\Services\TaxService;

class TaxController extends Controller
{
    protected $taxes;

    public function __construct(TaxService $taxes){
        $this->taxes = $taxes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = $this->taxes->all();
        return view('admin.taxes.index',['taxes'=>$taxes]);
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
        $tax = $this->taxes->store($request);
        return redirect()->action('TaxController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        //

        return response()->json($tax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        $tax = $this->taxes->update($request, $tax->id);
        return redirect()->action('TaxController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax = $this->taxes->destroy($tax->id);
        return redirect()->action('TaxController@index');
    }
}
