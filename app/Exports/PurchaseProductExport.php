<?php

namespace App\Exports;

use App\PurchaseProduct;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchaseProductExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return PurchaseProduct::query();
    }

    public function map($purchaseProduct): array
    {
        return [
            $purchaseProduct->inventory($purchaseProduct->inventory_id),
            $purchaseProduct->description,
            $purchaseProduct->quantity,
            $purchaseProduct->rate,
            $purchaseProduct->amount,
            $purchaseProduct->receive,
            $purchaseProduct->return,
            $purchaseProduct->receiver,
            $purchaseProduct->purchase_id,
            Carbon::createFromFormat('Y-m-d H:i:s', $purchaseProduct->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $purchaseProduct->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Inventory',
            'Description',
            'Quantity',
            'Rate',
            'Amount',
            'Receive',
            'Return',
            'Receiver',
            'Purchase Id',
            'Created At',
            'Updated At'
        ];
    }
}
