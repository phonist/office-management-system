<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Http\Traits\UseUuid;

class Quotation extends Model
{
    use UseUuid;
    protected $fillable = [
        'client_id',
        'estimate_date',
        'expiration_date',
        'total',
        'g_total',
        'status'
    ];

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }


    public function client($id){
        return Client::where('id',Quotation::where('id',$id)->first()->client_id)->first()->name;
    }
}
