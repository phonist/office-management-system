<?php

namespace App\Exports;

use App\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DeliverExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Order::query()->where('status','delivery_done');
    }

    public function map($order): array
    {
        return [
            $order->orderClient($order->id),
            $order->tracking_no,
            $order->delivery_person,
            Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Client',
            'Tracking No',
            'Delivery Person',
            'Created At',
            'Updated At'
        ];
    }
}
