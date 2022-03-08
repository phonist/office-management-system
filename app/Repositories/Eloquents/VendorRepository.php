<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IVendorRepository;
use Illuminate\Http\Request;
use App\Imports\VendorsImport;
use App\Vendor;
use File;
use Excel;
use Auth;

class VendorRepository implements IVendorRepository
{
    protected $vendors;

    public function __construct(Vendor $vendors)
    {
        $this->vendors = $vendors;
    }
    /**
     * Get all of the vendor for the given user.
     *
     * @param  Vendor  $vendor
     * @return Collection
     */
    public function all()
    {
        return $this->vendors->where('user_id', Auth::user()->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function store(Request $request){
        $vendor = new Vendor;
        $vendor->company = $request->company_name;
        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->fax = $request->fax;
        $vendor->email = $request->email;
        $vendor->website = $request->website;
        $vendor->billing_address = $request->b_address;
        $vendor->note = $request->note;
        $vendor->user_id = Auth::user()->id;
        return $vendor->save();
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
        $result = [];
        $vendor_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                $data = Excel::import(new VendorsImport, $request->import_file);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Vendors Data Imported!'];
                }else{
                    $result = ['result'=>false, 'status'=>'warning','message'=>'There is no data in csv file!'];
                }
            }else{
                $result = ['result'=>false, 'status'=>'warning','message'=>'Selected file is not csv!'];
            }
        }else{
            $result = ['result'=>false, 'status'=>'warning','message'=>'Something went wrong!'];
        }
        return $result;
    }

    public function show(Vendor $vendor){
        return $vendor;
    }

    public function edit(Vendor $vendor){
        return $vendor;
    }

    public function update(Request $request,Vendor $vendor){
        $vendor = Vendor::find($vendor->id);
        $vendor->name = $request->name;
        $vendor->company = $request->company_name;
        $vendor->phone = $request->phone;
        $vendor->fax = $request->fax;
        $vendor->email = $request->email;
        $vendor->website = $request->website;
        $vendor->billing_address = $request->b_address;
        $vendor->note = $request->note;
        return $vendor->save();
    }

    public function destroy(Vendor $vendor){
        $vendor = Vendor::find($vendor->id);
        return $vendor->delete();
    }

    public function getById($id){
        return $this->vendors->where('id',$id)->get();
    }
}