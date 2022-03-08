<?php

namespace App\Http\Controllers;

use App\PurchaseProduct;
use Illuminate\Http\Request;
use Session;
use App\Services\PurchaseProductService;

class PurchaseProductController extends Controller
{
    protected $purchaseProducts;

    public function __construct(PurchaseProductService $purchaseProducts){
        $this->purchaseProducts = $purchaseProducts;
    }
    /**
     * Display a listing of the resource.s
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->purchaseProducts->all();
        return view('admin.purchases.receive',[
            'purchases'=>$result['purchases'],
            'purchaseproducts'=>$result['purchaseproducts']
        ]);   
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
        $result = $this->purchaseProducts->store($request);
        if($result['result']){
            return response()->json('success');
        }else{
            return response()->json('failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseProduct $purchaseProduct)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseProduct $purchaseProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseProduct $purchaseProduct)
    {
        
    }

    public function updateReceivedAmt(Request $request){
        $result = $this->purchaseProducts->updateReceivedAmt($request);
        if($result['result']){
            Session::flash('success', 'Purchased Product Updated!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('purchases.show',$request->purchaseId);
    }

    public function updateReturnAmt(Request $request){
        $result = $this->purchaseProducts->updateReturnAmt($request);
        if($result['result']){
            Session::flash('success','Purchased Product Updated!');
        }else{
            Session::flash('failure','Something went wrong!');
        }
        return redirect()->route('purchases.show',$request->purchaseId);
    }

    public function getName(PurchaseProduct $purchaseProduct){
        $name = $this->purchaseProducts->getName($purchaseProduct->inventory_id);
        return response()->json($name);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseProduct $purchaseProduct)
    {
        //
    }

    public function export(){
        return $this->purchaseProducts->export();
    }
}
