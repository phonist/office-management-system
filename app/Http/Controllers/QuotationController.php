<?php

namespace App\Http\Controllers;

use App\Services\QuotationService;
use Illuminate\Http\Request;
use App\Quotation;
use App\Client;
use Session;

class QuotationController extends Controller
{
    protected $quotations;

    public function __construct(
        QuotationService $quotations
    ){
        $this->quotations = $quotations;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = $this->quotations->all();
        return view('admin.quotations.index',['quotations'=>$quotations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->quotations->create();
        return view('admin.quotations.create',[
            'clients'=>$result['clients'],
            'inventories'=>$result['inventories']
        ]);
    }

    public function createWithClient(Client $client){
        $result = $this->quotations->create();
        return view('admin.quotations.create',[
            'clients'=>$result['clients'],
            'inventories'=>$result['inventories'],
            'selected_client'=>$client
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inv_id = $request->inventory_id;
        array_splice($inv_id,0,1);
        array_splice($inv_id,count($inv_id)-1,1);

        $inv_desc = $request->inventory_desc;
        array_splice($inv_desc,0,1);
        array_splice($inv_desc,count($inv_desc)-1,1);

        $inv_qty = $request->inventory_qty;
        array_splice($inv_qty,0,1);
        array_splice($inv_qty,count($inv_qty)-1,1);

        $inv_rate = $request->inventory_rate;
        array_splice($inv_rate,0,1);
        array_splice($inv_rate,count($inv_rate)-1,1);

        $inv_amount = $request->inventory_amount;
        array_splice($inv_amount,0,1);
        array_splice($inv_amount,count($inv_amount)-1,1);
        if($request->total == null){
            $total = 0;
        }else{
            $total = $request->total;
        }
        if($request->tax == null){
            $tax = 0;
        }else{
            $tax = $request->tax;
        }
        if($request->discount == null){
            $discount = 0;
        }else{
            $discount = $request->discount;
        }
        if($request->g_total == null){
            $g_total = 0;
        }else{
            $g_total = $request->g_total;
        }
        
        $inventories = [];
        array_push($inventories, [
            'count'=>count($inv_id),
            'id' => $inv_id,
            'desc' => $inv_desc,
            'qty' => $inv_qty,
            'rate' => $inv_rate,
            'amt' => $inv_amount
        ]);
        $quotation = $this->quotations->store($request, $inventories[0]);
        return redirect()->route('quotations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        $result = $this->quotations->show($quotation);
        return view('admin.quotations.show',['quotation'=>$result['quotation'],'client'=>$result['client'],'quotation_products'=>$result['quotation_products']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $result = $this->quotations->edit($quotation);
        return view('admin.quotations.edit',[
            'inventories'=>$result['inventories'],
            'quotation'=>$result['quotations'],
            'client'=>$result['client'],
            'quotation_products'=>$result['quotation_products']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $inv_id = $request->inventory_id;
        array_splice($inv_id,0,1);
        array_splice($inv_id,count($inv_id)-1,1);

        $inv_desc = $request->inventory_desc;
        array_splice($inv_desc,0,1);
        array_splice($inv_desc,count($inv_desc)-1,1);

        $inv_qty = $request->inventory_qty;
        array_splice($inv_qty,0,1);
        array_splice($inv_qty,count($inv_qty)-1,1);

        $inv_rate = $request->inventory_rate;
        array_splice($inv_rate,0,1);
        array_splice($inv_rate,count($inv_rate)-1,1);

        $inv_amount = $request->inventory_amount;
        array_splice($inv_amount,0,1);
        array_splice($inv_amount,count($inv_amount)-1,1);
        if($request->total == null){
            $total = 0;
        }else{
            $total = $request->total;
        }
        if($request->tax == null){
            $tax = 0;
        }else{
            $tax = $request->tax;
        }
        if($request->discount == null){
            $discount = 0;
        }else{
            $discount = $request->discount;
        }
        if($request->g_total == null){
            $g_total = 0;
        }else{
            $g_total = $request->g_total;
        }
        $inventories = [];
        array_push($inventories, [
            'count'=>count($inv_id),
            'id' => $inv_id,
            'desc' => $inv_desc,
            'qty' => $inv_qty,
            'rate' => $inv_rate,
            'amt' => $inv_amount
        ]);
        $this->quotations->update($request, $quotation, $inventories[0]);
        return redirect()->route('quotations.show',$quotation->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        $result = $this->quotations->destroy($quotation);
        if($result){
            Session::flash('success', 'Quotation Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('quotations.index');
    }

    public function exportQuotation(){
        return $this->quotations->exportQuotation();
    }
}
