<?php

namespace App\Exports;

use App\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inventory::all();
    }
}
