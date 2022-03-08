<?php

namespace App\Imports;

use App\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class InventoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventory([
            'name' => $row['name'],
            'model_no' => $row['model_no'],
            'in_house' => $row['in_house'],
            'image' => $row['image'],
            's_price'=> $row['sales_price'],
            's_information'=> $row['sales_information'],
            'p_price'=> $row['purchase_cost'],
            'p_information'=> $row['purchase_information'],
            'quantity'=> $row['quantity'],
            'type'=> $row['type'],
            'category_id'=> $row['category_id'],
            'tax_id'=> $row['tax_id'],
            'user_id'=>Auth::user()->id
        ]);
    }
}
