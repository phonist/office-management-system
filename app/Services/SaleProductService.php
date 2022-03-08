<?php

namespace App\Services;

use App\Repositories\Interfaces\ISaleProductRepository;
use Illuminate\Http\Request;
use App\SaleProduct;

class SaleProductService {
    protected $saleProducts;

    public function __construct(ISaleProductRepository $saleProducts){
        $this->saleProducts = $saleProducts;
    }

    public function store(Request $request){
        return $this->saleProducts->store($request);
    }

    public function getByOrder($order_id){
        return $this->saleProducts->getByOrder($order_id);
    }
}