<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Order;

interface IOrderRepository
{
    public function all();
    public function store(Request $request);
    public function show(Order $order);
    public function edit(Order $order);
    public function update(Request $request, Order $order, $paid);
    public function destroy(Order $order);
    public function getOrderTotal($order_id);
    public function updatePaid($order_id, $total, $balance);
    public function getById($order_id);
    public function getByStatus($status);
    public function updateStatus(Order $order, $status);
}