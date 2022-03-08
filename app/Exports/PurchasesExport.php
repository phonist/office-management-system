<?php

namespace App\Exports;

use App\Purchase;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PurchasesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Purchase::query();
    }

    public function map($purchase): array
    {
        return [
            $purchase->vendor($purchase->id),
            $purchase->b_reference,
            $purchase->status,
            $purchase->note,
            $purchase->total,
            $purchase->discount,
            $purchase->tax,
            $purchase->transport,
            $purchase->g_total,
            $purchase->paid,
            $purchase->balance,
            Carbon::createFromFormat('Y-m-d H:i:s', $purchase->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $purchase->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Vendor',
            'Billing Address',
            'Status',
            'Note',
            'Total',
            'Discount',
            'Tax',
            'Transport',
            'Grand Total',
            'Paid',
            'Balance',
            'Created At',
            'Updated At'
        ];
    }
}
