<?php

namespace App\Services;

use App\Repositories\Interfaces\IQuotationProductRepository;
use Illuminate\Http\Request;

class QuotationProductService{
    protected $quotationProducts;

    public function __construct(IQuotationProductRepository $quotationProducts){
        $this->quotationProducts = $quotationProducts;
    }
}