<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Vendor;

interface IVendorRepository
{
    public function all();
    public function store(Request $request);
    public function import(Request $request);
    public function show(Vendor $vendor);
    public function edit(Vendor $vendor);
    public function update(Request $request, Vendor $vendor);
    public function destroy(Vendor $vendor);
    public function getById($id);
}