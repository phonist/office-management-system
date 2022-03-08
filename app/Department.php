<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobHistory;
use App\Department;
use App\Http\Traits\UseUuid;

class Department extends Model
{
    use UseUuid;
    //
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function jobHistory(){
        return $this->hasMany('JobHistory');
    }
}
