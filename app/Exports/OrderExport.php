<?php

namespace App\Exports;

use App\Order;
use App\Client;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Order::query();
    }

    public function map($order): array
    {
        return [
            $order->orderClient($order->id),
            $order->invoice_date,
            $order->due_date,
            $order->total,
            $order->g_total,
            $order->tax,
            $order->discount,
            $order->paid,
            $order->balance,
            $order->receive_amt,
            $order->amt_due,
            $order->tracking_no,
            $order->delivery_person,
            $order->status,
            $order->order_note,
            $order->order_activities,
            Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Client',
            'Date',
            'Due Date',
            'Total',
            'Grand Total',
            'Tax',
            'Discount',
            'Paid',
            'Balance',
            'Received Amount',
            'Amount Due',
            'Tracking No.',
            'Delivery Person',
            'Status',
            'Order Note',
            'Order Activities',
            'Created At',
            'Updated At'
        ];
    }
}
