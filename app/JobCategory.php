<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class JobCategory extends Model
{
    use UseUuid;
    //
    protected $fillable = [
        'category',
        'user_id'
    ];

    public function jobHistory(){
        return $this->hasMany('JobHistory');
    }
}
