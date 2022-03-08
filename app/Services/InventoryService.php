<?php

namespace App\Services;

use App\Repositories\Interfaces\IInventoryRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ITaxRepository;
use Illuminate\Http\Request;
use App\Inventory;
use App\Imports\InventoryImport;
use File;
use Excel;

class InventoryService{
    protected $inventories;
    protected $categories;
    protected $taxes;

    public function __construct(
        IInventoryRepository $inventories,
        ICategoryRepository $categories,
        ITaxRepository $taxes
    ){
        $this->inventories = $inventories;
        $this->categories = $categories;
        $this->taxes = $taxes;
    }

    public function all(){
        $inventories = $this->inventories->all();
        $categories = $this->categories->all();
        $taxes = $this->taxes->all();
        return [
            'inventories'=>$inventories,
            'categories'=>$categories,
            'taxes'=>$taxes
        ];
    }

    public function import(){
        $categories = $this->categories->all();
        $taxes = $this->taxes->all();
        return [
            'categories'=>$categories,
            'taxes'=>$taxes
        ];
    }

    public function getFileName(Request $request){
        $file_name = "";
        if ($request->hasFile('p_image')) {
            $image = $request->file('p_image');
            $file_name = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $file_name);
        }else{
            $file_name = "image.png";
        }
        return $file_name;
    }

    public function store(Request $request, $file_name){
        return $this->inventories->store($request, $file_name);
    }

    public function getById($id){
        return $this->inventories->getById($id);
    }

    public function update(Request $request, $file_name, $id){
        return $this->inventories->update($request, $file_name, $id);
    }

    public function downloadInventorySample(){
        $file_path = storage_path() . "/app/downloads/inventory.csv";
        $headers = array(
            'Content-Type: csv',
            'Content-Disposition: attachment; filename=inventory.csv',
        );
        if(file_exists($file_path)){
            return ['result'=>true, 'file_path'=>$file_path, 'headers'=>$headers];
        }else{
            return ['result'=>false];
        }
    }

    public function importInventory(Request $request){
        $product_name = [];
        if ($request->hasFile('import_file')) {
            $extension = File::extension($request->import_file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->import_file->getRealPath();
                // $data = Excel::load($path, function($reader) {})->get();
                $data = Excel::import(new InventoryImport, $request->import_file);
                if(!empty($data)){
                    $result = ['result'=>true, 'status'=>'success','message'=>'Inventories Data Imported!'];
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

    public function destroy(Inventory $inventory){
        return $this->inventories->destroy($inventory->id);
    }

    public function delete(Request $request){
        if($request->inventory != null){
            foreach($request->inventory as $id){
                $result = $this->inventories->destroy((int)$id);
            }
            return ['result'=>$result, 'status'=>'success','message'=>'Inventory Data Deleted'];
        }else{
            return ['result'=>$result, 'status'=>'fail','message'=>'Something went wrong'];
        }
    }
}