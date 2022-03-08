<?php

namespace App\Imports;

use App\Vendor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class VendorsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Vendor([
            //
            'name' => $row['name'],
            'company'=> $row['company'],
            'phone'=> $row['phone'],
            'fax'=> $row['fax'],
            'email'=> $row['email'],
            'website'=> $row['website'],
            'billing_address'=> $row['billing_address'],
            'note'=> $row['note'],
            'user_id'=> Auth::user()->id
        ]);
    }
}
