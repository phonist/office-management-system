<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISaleProductRepository;
use App\SaleProduct;

class SaleProductRepository implements ISaleProductRepository
{
    protected $saleProducts;

    public function __construct(SaleProduct $saleProducts){
        $this->saleProducts = $saleProducts;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
    }

    public function storeByOrder($id, $desc, $qty, $rate, $amt, $order_id){
        $saleProduct = $this->saleProducts;
        $saleProduct->inventory_id = $id;
        $saleProduct->description = $desc;
        $saleProduct->quantity = $qty;
        $saleProduct->rate = $rate;
        $saleProduct->amount = $amt;
        $saleProduct->invoice_id = $order_id;
        return [
            'result'=>$saleProduct->save(),
            'saleProduct'=>$saleProduct
        ];
    }

    public function getByOrder($order_id){
        return $this->saleProducts->where('invoice_id',$order_id)->get();
    }

    public function store($id, $desc, $qty, $rate, $amt, $order_id){
        $saleProduct = $this->saleProducts;
        $saleProduct->inventory_id = $id;
        $saleProduct->description = $desc;
        $saleProduct->quantity = (int)$qty;
        $saleProduct->rate = $rate;
        $saleProduct->amount = $amt;
        $saleProduct->invoice_id = $order_id;
        return [
            'result' => $saleProduct->save(),
            'saleProduct' => $saleProduct
        ];
    }

    public function update($sale_id, $id, $desc, $qty, $rate, $amt, $order_id){
        $saleProduct = $this->saleProducts->find($sale_id);
        $saleProduct->inventory_id = $id;
        $saleProduct->description = $desc;
        $saleProduct->quantity = (int)$qty;
        $saleProduct->rate = $rate;
        $saleProduct->amount = $amt;
        $saleProduct->invoice_id = $order_id;
        return [
            'result' => $saleProduct->save(),
            'saleProduct' => $saleProduct
        ];
    }

    public function destroy($id){
        $remove = $this->saleProducts->find($id);
        return [
            'result' => $remove->delete()
        ];
    }
}