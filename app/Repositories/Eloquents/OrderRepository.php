<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IOrderRepository;
use Illuminate\Http\Request;
use App\Order;
use App\Client;
use Auth;

class OrderRepository implements IOrderRepository
{
    protected $orders;
    protected $clients;

    public function __construct(Order $orders, Client $clients){
        $this->orders = $orders;
        $this->clients = $clients;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->orders
                    ->leftjoin('clients','orders.client_id','clients.id')
                    ->where('clients.user_id',Auth::user()->id)
                    ->addSelect(['client'=> $this->clients->select('name')->whereColumn('id','orders.client_id')])
                    ->orderBy('orders.created_at', 'asc')
                    ->get();
    }

    public function store(Request $request){
        $order = $this->orders;
        $order->invoice_number = $request->invoice_number;
        $order->client_id = $request->client_id;
        $order->invoice_date = $request->invoice_date;
        $order->due_date = $request->due_date;
        $order->total = $request->total;
        $order->g_total = $request->g_total;
        $order->tax = $request->tax;
        $order->discount = $request->discount;
        $order->receive_amt = 0;
        $order->amt_due = 0;
        $order->paid = 0;
        $order->balance = 0;
        $order->status = 'processing_order';
        $order->order_note = $request->order_note;
        $order->order_activities = $request->order_activities;
        return [
            'result'=>$order->save(),
            'order'=>$order
        ];
    }

    public function show(Order $order){
        return $order;
    }

    public function edit(Order $order){
        return $order;
    }

    public function update(Request $request, Order $order, $paid){
        $order = $this->orders->find($order->id);
        $order->invoice_date = $request->invoice_date;
        $order->due_date = $request->due_date;
        $order->total = $request->total;
        $order->g_total = $request->g_total;
        $order->tax = $request->tax;
        $order->balance = $request->g_tax - $paid;
        $order->discount = $request->discount;
        $order->order_note = $request->order_note;
        $order->order_activities = $request->order_activities;
        return [
            'result'=>$order->save(),
            'order'=>$order
        ];
    }

    public function destroy(Order $order){
        $order = $this->orders->find($order->id);
        return $order->delete();
    }

    public function getOrderTotal($order_id){
        return $this->orders->select('g_total')->where('id',$order_id)->get();
    }

    public function updatePaid($order_id, $total, $balance){
        $order = $this->orders->find($order_id);
        $order->paid = $total;
        $order->balance = $balance;
        return $order->save();
    }

    public function getById($order_id){
        return $this->orders->find($order_id);
    }

    public function getByStatus($status){
        return $this->orders->where('status',$status)->get();
    }

    public function updateStatus(Order $order, $status){
        $updateStatus = $this->orders->find($order->id);
        $updateStatus->status = $status;
        return $updateStatus->save();
    }
}