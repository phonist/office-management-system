<?php

namespace App\Exports;

use App\Reimbursement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReimbursementExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Reimbursement::query();
    }

    public function map($reimbursement): array
    {
        return [
            $reimbursement->date,
            $reimbursement->department($reimbursement->department_id),
            $reimbursement->employee($reimbursement->employee_id),
            $reimbursement->amount,
            $reimbursement->description,
            $reimbursement->m_approved,
            $reimbursement->m_comment,
            $reimbursement->a_approved,
            $reimbursement->a_comment,
            Carbon::createFromFormat('Y-m-d H:i:s', $reimbursement->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $reimbursement->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Date',
            'Department',
            'Employee',
            'Amount',
            'Description',
            'Manager Approved',
            'Manager Comment',
            'Admin Approved',
            'Admin Comment',
            'Created At',
            'Updated At'
        ];
    }
}
