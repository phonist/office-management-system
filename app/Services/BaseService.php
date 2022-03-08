<?php

namespace App\Services;

use Carbon\Carbon;

class BaseService {

    public function invoiceNumber($latest, $initial)
    {
        $date = Carbon::today()->format('Ymd');
        if (!$latest) return $initial.$date.'0001';
        $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_number);
        return $initial.sprintf('%04d', $string+1);
    }
}