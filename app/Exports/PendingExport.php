<?php

namespace App\Exports;

use App\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendingExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Order::query()->where('status','awaiting_delivery');
    }

    public function map($order): array
    {
        return [
            $order->orderClient($order->id),
            $order->due_date,
            $order->balance,
            $order->total,
            Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Client',
            'Due Date',
            'Due Payment',
            'Total',
            'Created At',
            'Updated At'
        ];
    }
}
