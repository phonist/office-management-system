<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\SaleProduct;

interface ISaleProductRepository
{
    public function storeByOrder($id, $desc, $qty, $rate, $amt, $order_id);
    public function getByOrder($order_id);
    public function store($id, $desc, $qty, $rate, $amt, $order_id);
    public function update($sale_id, $id, $desc, $qty, $rate, $amt, $order_id);
    public function destroy($id);
}