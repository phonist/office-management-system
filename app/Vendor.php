<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;

class Vendor extends Model
{
    use UseUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company',
        'phone',
        'open_balance',
        'fax',
        'email',
        'website',
        'billing_address',
        'note',
        'user_id',
        'created_at',
        'updated_at',
    ];


    public function purchase(){
        return $this->hasMany('App\Purchase');
    }
}
