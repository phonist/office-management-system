<?php

namespace App\Exports;

use App\Quotation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuotationExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Quotation::query();
    }

    public function map($quotation): array
    {
        return [
            $quotation->client($quotation->id),
            $quotation->estimate_date,
            $quotation->expiration_date,
            $quotation->total,
            $quotation->g_total,
            $quotation->tax,
            $quotation->discount,
            $quotation->status,
            $quotation->quotation_activities,
            $quotation->quotation_note,
            Carbon::createFromFormat('Y-m-d H:i:s', $quotation->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $quotation->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Client',
            'Estimate Date',
            'Expiration Date',
            'Total',
            'Grand Total',
            'Tax',
            'Discount',
            'Status',
            'quotation Activities',
            'quotation Note',
            'Created At',
            'Updated At'
        ];
    }
}
