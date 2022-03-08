<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Session;
use App\Order;
use App\Client;

class OrderController extends Controller
{
    protected $orders;

    public function __construct(
        OrderService $orders
    )
    {
        $this->orders = $orders;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = $this->orders->all();
        return view('admin.orders.index',['invoice'=>$invoice]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = $this->orders->create();
        return view('admin.orders.create',[
            'inventories'=> $result['inventories'],
            'clients'=>$result['clients']
        ]);
    }

    public function createWithClient(Client $client)
    {
        $result = $this->orders->create();
        return view('admin.orders.create',[
            'inventories'=>$result['inventories'],
            'clients'=>$result['clients'],
            'selected_client'=>$client
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process()
    {
        $processing_order = $this->orders->getByStatus('processing_order');
        return view('admin.orders.process',['invoice'=>$processing_order]);
    }

    public function updateStatusToShipping(Order $order){
        $this->orders->updateStatus($order, 'awaiting_delivery');
        return redirect()->route('orders.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $pending_order = $this->orders->getByStatus('awaiting_delivery');
        return view('admin.orders.pending',['invoice'=>$pending_order]);
    }

    public function updateStatusToShipped(Order $order){
        $this->orders->updateStatus($order, 'delivery_done');
        return redirect()->route('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliver()
    {
        $delivered_order = $this->orders->getByStatus('delivery_done');
        return view('admin.orders.deliver',['invoice'=>$delivered_order]);
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
        array_push($inventories,[
            'count'=>count($inv_id),
            'id'=>$inv_id,
            'desc'=>$inv_desc,
            'qty'=>$inv_qty,
            'rate'=>$inv_rate,
            'amt'=>$inv_amount
        ]);
        $result = $this->orders->store($request, $inventories[0]);
        return redirect()->route('orders.show',$result['order']->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $invoice = $this->orders->show($order);
        return view('admin.orders.show',[
            'invoice'=>$invoice['invoice'],
            'sale_products'=>$invoice['sale_product'],
            'client'=>$invoice['client'][0],
            'payments'=>$invoice['payments']
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $invoice = $this->orders->edit($order);
        return view('admin.orders.edit',[
            'invoice'=>$invoice['invoice'],
            'clients'=>$invoice['clients'][0],
            'sale_product'=>$invoice['sale_product'],
            'inventories'=>$invoice['inventories']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
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

        $paid = Order::select('paid')->where('id',$order->id)->first()->paid;
        $inventories = [];

        array_push($inventories,[
            'count'=>count($inv_id),
            'id'=>$inv_id,
            'desc'=>$inv_desc,
            'qty'=>$inv_qty,
            'rate'=>$inv_rate,
            'amt'=>$inv_amount,
            'sale_id'=>$request->sale_id
        ]);
        // return response()->json($request);
        $updateInvoice = $this->orders->update($request, $order, $paid, $inventories[0]);
        return redirect()->route('orders.show',$order->id);
    }

    public function exportOrder(){
        return $this->orders->exportOrder();
    }

    public function exportProcessing(){
        return $this->orders->exportProcessing();
    }

    public function exportPending(){
        return $this->orders->exportPending();
    }

    public function exportDeliver(){
        return $this->orders->exportDeliver();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $this->orders->destroy($order);
        return redirect()->route('orders.index');
    }

}
