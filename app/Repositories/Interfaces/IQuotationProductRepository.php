<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\QuotationProduct;

interface IQuotationProductRepository
{
    public function store($id, $desc, $qty, $rate, $amt, $quotation_id);
    public function getByQuotationId($quotation_id);
    public function update($id, $desc, $qty, $rate, $amt, $quotation_id);
    public function destroy($id);
}