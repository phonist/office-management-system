<?php

namespace App\Services;

use App\Repositories\Interfaces\IVendorRepository;
use Illuminate\Http\Request;
use App\Vendor;

class VendorService {
    protected $vendors;

    public function __construct(IVendorRepository $vendors){
        $this->vendors = $vendors;
    }

    public function all(){
        return $this->vendors->all();
    }

    public function store(Request $request){
        return $this->vendors->store($request);
    }

    public function downloadVendorSample(){
        $file_path = storage_path() . "/app/downloads/vendor.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=vendor.csv',
        );
        return ['result'=>file_exists($file_path),'file_path'=>$file_path,'headers'=>$headers];
    }

    public function import(Request $request){
        return $this->vendors->import($request);
    }

    public function show(Vendor $vendor){
        return $this->vendors->show($vendor);
    }

    public function edit(Vendor $vendor){
        return $this->vendors->edit($vendor);
    }

    public function update(Request $request, Vendor $vendor){
        return $this->vendors->update($request, $vendor);
    }

    public function destroy(Vendor $vendor){
        return $this->vendors->destroy($vendor);
    }
}