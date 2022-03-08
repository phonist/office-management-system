<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IInventoryRepository;
use Illuminate\Http\Request;
use App\Inventory;
use Auth;

class InventoryRepository implements IInventoryRepository
{
    protected $inventories;

    public function __construct(Inventory $inventories){
        $this->inventories = $inventories;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->inventories
                    ->where('user_id',Auth::user()->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function getNameById($id){
        return $this->inventories->where('id',$id)->first()->name;
    }

    public function store(Request $request, $file_name){
        $inventory = $this->inventories;
        $inventory->name = $request->name;
        $inventory->model_no = $request->model_no;
        $inventory->in_house = $request->in_house;
        $inventory->image = $file_name;
        $inventory->s_price = $request->sales_cost;
        $inventory->s_information = $request->sales_info;
        $inventory->p_price = $request->buying_cost;
        $inventory->p_information = $request->buying_info;
        $inventory->category_id = $request->category;
        $inventory->tax_id = $request->tax;
        $inventory->quantity = $request->inventory;
        $inventory->type = $request->type;
        $inventory->user_id = Auth::user()->id;
        return [
            'result'=>$inventory->save(),
        ];
    }

    public function getById($id){
        return $this->inventories->where('id',$id)->get();
    }

    public function update(Request $request, $file_name, $id){
        $inventory = $this->inventories->find($id);
        $inventory->name = $request->name;
        $inventory->model_no = $request->model_no;
        $inventory->in_house = $request->in_house;
        $inventory->image = $file_name;
        $inventory->s_price = $request->sales_cost;
        $inventory->s_information = $request->sales_info;
        $inventory->p_price = $request->buying_cost;
        $inventory->p_information = $request->buying_info;
        $inventory->category_id = $request->category;
        $inventory->tax_id = $request->tax;
        $inventory->quantity = $request->inventory;
        $inventory->type = $request->type;
        return [
            'result'=>$inventory->save()
        ];
    }

    public function destroy($id){
        $delete = $this->inventories->find($id);
        return $delete->delete();
    }

    public function getQuantity($id){
        return $this->inventories->where('id',$id)->first()->quantity;
    }

    public function updateQuantity($id, $quantity){
        $inventories = $this->inventories->find($id);
        $inventories->quantity = $quantity;
        $inventories->save();
        return $inventories;
    }
}