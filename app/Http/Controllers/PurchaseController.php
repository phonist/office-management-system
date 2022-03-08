<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use App\Vendor;
use App\Services\PurchaseService;

class PurchaseController extends Controller
{
    protected $purchases;

    public function __construct(PurchaseService $purchases){
        $this->purchases = $purchases;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->purchases->all();
        return view('admin.purchases.index',[
            'purchases'=>$result['purchases'],
            'payments'=>$result['payments'],
            'vendor'=>$result['vendor']
        ]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->purchases->create();
        return view('admin.purchases.create',[
            'vendors'=>$result['vendors'],
            'inventories'=>$result['inventories']
        ]);
    }

    public function createWithVendor(Vendor $vendor){
        $result = $this->purchases->create();
        return view('admin.purchases.create',[
            'vendors'=>$result['vendors'],
            'inventories'=>$result['inventories'],
            'selected_vendor'=>$vendor
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
        if($request->shipping == null){
            $transport = 0;
        }else{
            $transport = $request->shipping;
        }
        if($request->total == null){
            $total = 0;
        }else{
            $total = $request->total;
        }
        if($request->g_total == null){
            $g_total = 0;
        }else{
            $g_total = $request->g_total;
        }
        $inventories = [];
        array_push($inventories,[
            'count' => count($inv_id),
            'id' => $inv_id,
            'desc' => $inv_desc,
            'qty' =>$inv_qty,
            'rate'=>$inv_rate,
            'amt' => $inv_amount
        ]);
        $purchase = $this->purchases->store($request, $inventories[0]);
        return redirect()->route('purchases.show',$purchase['id']);
    }

    public function getBalance(Purchase $purchase){
        $leftAmount=$purchase->g_total-$purchase->paid;
        return response()->json($leftAmount);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {   
        $result = $this->purchases->show($purchase);
        return view('admin.purchases.show',[
            'purchase'=>$result['purchases'][0],
            'purchase_products'=>$result['purchase_products'],
            'vendors'=>$result['vendor'][0],
            'payments'=>$result['payments']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $result = $this->purchases->edit($purchase);
        return response()->json([
            'purchases'=>$result['purchases'],
            'purchaseProducts'=>$result['purchaseProducts']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    } 
    
    public function export(){
        return $this->purchases->export();
    }

    public function exportReceivedProduct(){
        // return (new ReceivedProductExport)->download('purchases.csv');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $this->purchases->destroy($purchase);
        return redirect()->route('purchases.index');
    }
}
