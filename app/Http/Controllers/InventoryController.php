<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;
use App\Inventory;
use Response;

class InventoryController extends Controller
{

    protected $inventories;

    public function __construct(InventoryService $inventories){
        $this->inventories = $inventories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->inventories->all();
        if(empty($result)){
            return view('admin.inventory.index',['inventories'=>'No Inventory']);
        }else{
            return view('admin.inventory.index',[
                'inventories'=>$result['inventories'],
                'categories'=>$result['categories'],
                'taxes'=>$result['taxes']
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        $result = $this->inventories->import();
        return view('admin.inventory.import',[
            'categories'=>$result['categories'],
            'taxes'=>$result['taxes']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'p_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $file_name = $this->inventories->getFileName($request);
        $result = $this->inventories->store($request, $file_name);
        
        if($result['result']){
            flash()->success('Inventory Inserted Successfully!');
        }else{
            flash()->error('Something went wrong!');
        }
        return redirect()->route('inventory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {   
        // $data = Inventory::where('id',$inventory->id)->get();
        $inventories = $this->inventories->getById($inventory->id);
        return response()->json($inventories[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $inventories = $this->inventories->getById($inventory->id);
        return response()->json(['inventory'=>$inventories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $this->validate($request, [
            'edited_p_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file_name = $this->inventories->getFileName($request);
        $result = $this->inventories->update($request, $file_name, $inventory->id);
        
        if($result['result']){
            flash()->success('Inventory Data Updated!');
        }else{
            flash()->error('Something went wrong!');
        }
        return redirect()->route('inventory.index');    
    }

    public function downloadInventorySample(){
        $result = $this->inventories->downloadInventorySample();
        if ($result['result']) {
            flash()->success('File Downloaded!');
            return Response::download($result['file_path'], 'inventory.csv', $result['headers']);
        } else {
            flash()->error('Something went wrong!');
        }
        return redirect()->route('inventory.index');
    }

    // import Inventory csv file
    public function importInventory(Request $request){
        $result = $this->inventories->importInventory($request);
        if($result['result'] && $result['status']=='success'){
            flash()->success($result['message']);
        }else if($result['result'] && $result['status']=='warning'){
            flash()->warning($result['message']);
        }else{
            flash()->error($result['message']);
        }
        return redirect()->route('inventory.index');    
    }
    /*
     * Remove the specified resource from storage.
     *  
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        // Inventory::find($inventory->id)->delete();
        $result = $this->inventories->destroy($inventory);
        return response()->json(['success'=>'deleted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $Inventory
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $result = $this->inventories->delete($request);
        if($result['result']){
            flash()->success($result['message']);
        }else{
            flash()->error($result['message']);
        }
        return redirect()->route('inventory.index'); 
    }
}
