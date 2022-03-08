<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Quotation;

interface IQuotationRepository{
    public function all();
    public function store(Request $request);
    public function show(Quotation $quotation);
    public function edit(Quotation $quotation);
    public function update(Request $request, Quotation $quotation);
    public function destroy(Quotation $quotation);
}