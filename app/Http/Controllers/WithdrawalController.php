<?php

namespace App\Http\Controllers;

use App\Services\WithdrawalService;
use Illuminate\Http\Request;
use App\Withdrawal;
use Session;

class WithdrawalController extends Controller
{
    protected $withdrawals;

    public function __construct(WithdrawalService $withdrawals){
        $this->withdrawals = $withdrawals;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawals = $this->withdrawals->all();
        return view('admin.withdrawals.index',['withdrawals'=>$withdrawals]);
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
        $result = $this->withdrawals->store($request);
        return redirect()->action('InventoryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        return response()->json($withdrawal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        $update = $this->withdrawals->update($request, $withdrawal->id);
        return redirect()->route('withdrawals.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
        $data = $this->withdrawals->destroy($withdrawal);
        if($data){
            Session::flash('success', 'Withdrawal Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('withdrawals.index'); 
    }
}
